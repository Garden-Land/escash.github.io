<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 22.04.2017
 * Time: 16:35
 */

namespace App\Http\Controllers;

use App\Cases;
use App\Item;
use App\Live;
use App\Order;
use App\User;
use App\Withdraw;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{

    /*
     * Подгружаем информацию о сайте
     */
    public function info()
    {
        $users = User::count('id');
        $openBox = Live::count('id');
        $userss = User::orderBy('open_sum', 'desc')->take(20)->get();
        $topUsers = [];
        $liveFeed = Live::orderBy('id', 'desc')->take(20)->get();
        $liveFee = [];
        foreach ($userss as $user) {
            $topUsers[] = [
                'avatar' => $user->avatar,
                'id' => $user->id,
                'name' => $user->name,
                'open_box' => $user->open_box,
                'open_sum' => $user->open_sum
            ];
        }
        foreach ($liveFeed as $live) {
            $box = Cases::where('id', $live->case_id)->first();
            $item = Item::where('id', $live->item_id)->first();
            $user = User::where('id', $live->user_id)->first();
            $liveFee[] = [
                'Box' => [
                    'name' => $box->name,
                    'type' => $box->type,
                    'img' => $box->img
                ],
                'Item' => [
                    'id' => $item->id,
                    'sell_price' => $item->sell_price,
                    'type' => $item->type,
                    'img' => $item->img
                ],
                'User' => [
                    'id' => $user->id,
                    'avatar' => $user->avatar,
                    'name' => $user->name
                ]
            ];
        }
        if (Auth::guest()) {
            return response()->json([
                'box' => $openBox,
                'users' => $users,
                'liveFeed' => $liveFee,
                'topUsers' => $topUsers
            ]);
        } else {
            return response()->json([
                'box' => $openBox,
                'users' => $users,
                'liveFeed' => $liveFee,
                'topUsers' => $topUsers,
                'user' => $this->user,
                'token' => $this->user->remember_token
            ]);
        }
    }

    /*
     * Подгружаем кейсы
     */
    public function boxes()
    {
        $cases = Cases::orderBy('id', 'asc')->get();
        foreach ($cases as $case) {
            $itemsCase = json_decode($case->items);
            $items = [];
            foreach ($itemsCase as $item1) {
                $item = Item::where('id', $item1)->first();
                $items[] = [
                    'id' => $item->id,
                    'sell_price' => $item->sell_price,
                    'type' => $item->type,
                    'img' => $item->img
                ];
            }
            $case->Items = $items;
        }
        return $cases;
    }

    /*
     * Открываем кейс
     */
    public function openBox(Request $r)
    {
        $id = $r->boxId;
        $case = Cases::where('id', $id)->first();
        if (Auth::guest()) return response()->json(['error' => 'Авторизуйтесь на сайте!']);
        if (is_null($case)) return response()->json(['error' => 'Кейс не найден!']);
        if ($case->price > $this->user->balance) return response()->json(['error' => 'У вас недостаточно средств!']);
        $items = [];
        $allChance1 = 0;
        $items1 = json_decode($case->items);
        foreach ($items1 as $item1) {
            $item = Item::where('id', $item1)->first();
            $items[] = $item;
            $allChance1 += $item->chance;
        }
        $newItem = [];
        $lastChance = 0;
        $allChance = 0;
        if ($this->user->role == 'youtuber') {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price >= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                } else {
                    $items[$i]->chance = $items[$i]->chance - 50;
                }
                $allChance += $items[$i]->chance;
            }
        } else {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price <= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                }
                $allChance += $items[$i]->chance;
            }
        }
        if ($allChance == 0) $allChance = $allChance1;
        $chance = mt_rand(0, $allChance);
        for ($i = 0; $i < count($items); $i++) {
            if ($i == 0) {
                if ($chance <= $items[$i]->chance) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $items[$i]->chance;
            } else {
                if (($chance > $lastChance) && ($chance <= ($lastChance + $items[$i]->chance))) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $lastChance + $items[$i]->chance;
            }
        }
        if ($newItem == []) {
            $rand = array_rand($items);
            $item = $items[$rand];
        } else {
            $rand_element = rand(0, count($newItem) - 1);
            $item = $newItem[$rand_element];
        }
        $balanceTo = $this->user->balance - $case->price;
        $this->user->update([
            'open_box' => $this->user->open_box + 1,
            'open_sum' => $this->user->open_sum + $item->sell_price,
            'balance' => ($balanceTo) + $item->sell_price
        ]);
        $case->update([
            'total_given' => $case->total_given + $item->sell_price
        ]);
        Live::create([
            'user_id' => $this->user->id,
            'item_id' => $item->id,
            'case_id' => $case->id
        ]);
        $returnValue = [
            'Box' => [
                'name' => $case->name,
                'type' => $case->type,
                'img' => $case->img
            ],
            'Item' => [
                'id' => $item->id,
                'sell_price' => $item->sell_price,
                'type' => $item->type,
                'img' => $item->img
            ],
            'User' => [
                'id' => $this->user->id,
                'avatar' => $this->user->avatar,
                'name' => $this->user->name
            ],
            'balanceTo' => $balanceTo,
            'fake' => false
        ];
        Redis::publish('purchase', json_encode($returnValue));
        $winItem = [
            'id' => $item->id,
            'sell_price' => $item->sell_price,
            'type' => $item->type,
            'img' => $item->img
        ];
        return response()->json(['result' => $winItem]);
    }

    /*
     * Фейк-открытия
     */
    public function fakeOpen()
    {
        $user = User::where('role', 'fake')->orderByRaw('RAND()')->first();
        if (is_null($user)) return 'Not found user-fake';
        $case = Cases::orderByRaw('RAND()')->first();
        $items = [];
        $allChance1 = 0;
        $items1 = json_decode($case->items);
        foreach ($items1 as $item1) {
            $item = Item::where('id', $item1)->first();
            $items[] = $item;
            $allChance1 += $item->chance;
        }
        $newItem = [];
        $lastChance = 0;
        $allChance = 0;
        if ($user->role == 'youtuber') {
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]->sell_price >= $case->price) {
                    $items[$i]->chance = $items[$i]->chance + 50;
                } else {
                    $items[$i]->chance = $items[$i]->chance - 50;
                }
                $allChance += $items[$i]->chance;
            }
        }
        if ($allChance == 0) $allChance = $allChance1;
        $chance = mt_rand(0, $allChance);
        for ($i = 0; $i < count($items); $i++) {
            if ($i == 0) {
                if ($chance <= $items[$i]->chance) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $items[$i]->chance;
            } else {
                if (($chance > $lastChance) && ($chance <= ($lastChance + $items[$i]->chance))) {
                    $newItem[] = $items[$i];
                }
                $lastChance = $lastChance + $items[$i]->chance;
            }
        }
        if ($newItem == []) {
            $rand = array_rand($items);
            $item = $items[$rand];
        } else {
            $rand_element = rand(0, count($newItem) - 1);
            $item = $newItem[$rand_element];
        }
        $user->update([
            'open_box' => $user->open_box + 1,
            'open_sum' => $user->open_sum + $item->sell_price
        ]);
        $case->update([
            'total_given' => $case->total_given + $item->sell_price
        ]);
        Live::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'case_id' => $case->id
        ]);
        $returnValue = [
            'Box' => [
                'name' => $case->name,
                'type' => $case->type,
                'img' => $case->img
            ],
            'Item' => [
                'id' => $item->id,
                'sell_price' => $item->sell_price,
                'type' => $item->type,
                'img' => $item->img
            ],
            'User' => [
                'id' => $user->id,
                'avatar' => $user->avatar,
                'name' => $user->name
            ],
            'fake' => true
        ];
        Redis::publish('purchase', json_encode($returnValue));
        $winItem = [
            'id' => $item->id,
            'sell_price' => $item->sell_price,
            'type' => $item->type,
            'img' => $item->img
        ];
        return response()->json(['result' => $winItem]);
    }

    /*
     * Получаем авторизованного пользователя
     */
    public function authenticate(Request $r)
    {
        $user = User::where('remember_token', $r->token)->first();
        if (is_null($user)) return response()->json(['success' => 'false']);
        return response()->json([
            'success' => true,
            'returnValue' => [
                'user_id' => $user->id,
                'iat' => time()
            ],
            'user' => $user
        ]);
    }

    /*
     * Получаем профиль пользователя
     */
    public function user($id)
    {
        $user = User::where('id', $id)->first();
        if (is_null($user)) die();
        $openBox = Live::where('user_id', $user->id)->orderBy('id', 'desc')->take(20)->get();
        $purchase = [];
        foreach ($openBox as $live) {
            $box = Cases::where('id', $live->case_id)->first();
            $item = Item::where('id', $live->item_id)->first();
            $purchase[] = [
                'Box' => [
                    'id' => $box->id,
                    'name' => $box->name,
                    'type' => $box->id,
                    'img' => $box->img
                ],
                'Item' => [
                    'id' => $item->id,
                    'sell_price' => $item->sell_price,
                    'type' => $item->type,
                    'img' => $item->img
                ],
                'id' => $live->id,
                'item_id' => $item->id
            ];
        }
        $affiliates = [];
        if (!is_null($user->affiliate_code)) {
            $users = User::where('affiliate_use', $user->affiliate_code)->count('id');
            $affiliates[0] = [
                'count' => $users
            ];
        }
        $user->UserAffiliates = $affiliates;
        return response()->json([
            'user' => $user,
            'purchase' => $purchase
        ]);
    }

    /*
     * Активируем промо-код
     */
    public function activateAffiliate(Request $r)
    {
        $code = $r->affiliate_code;
        $user = User::where('affiliate_code', $code)->first();
        if (is_null($user)) return response()->json(['type' => 'error', 'msg' => 'Данного кода не существует!']);
        if ($this->user->affiliate_code == $code) return response()->json(['type' => 'error', 'msg' => 'Нельзя активировать свой код!']);
        if (!is_null($this->user->affiliate_use)) return response()->json(['type' => 'error', 'msg' => 'Вы уже активировали код!']);
        $this->user->update([
            'affiliate_use' => $code,
            'balance' => $this->user->balance + $this->config->ref_sum
        ]);
        Redis::publish('balance', json_encode($this->user));
        return response()->json([
            'type' => 'success',
            'msg' => 'Код активирован!'
        ]);
    }

    /*
     * Изменяем промо-код
     */
    public function affiliate(Request $r)
    {
        $code = $r->affiliate_code;
        $user = User::where('affiliate_code', $code)->first();
        if (!is_null($user)) return response()->json(['type' => 'error', 'msg' => 'Данный код уже существует']);
        $this->user->update([
            'affiliate_code' => $code
        ]);
        return response()->json([
            'type' => 'success',
            'msg' => 'Код сохранен!'
        ]);
    }

    /*
     * Выводы
     */
    public function withdraws()
    {
        $withdraws = Withdraw::where('user_id', $this->user->id)->orderBy('id', 'desc')->get();
        return $withdraws;
    }

    /*
     * Вывод
     */
    public function withdraw(Request $r)
    {
        $amount = $r->amount;
        $payway = $r->payway;
        $openBox = Live::where('user_id', $this->user->id)->count('id');
        if ($payway == 'null '.$r->account) return response()->json(['success' => false, 'message' => 'Выберите платежную систему.']);
        if ($amount < $this->config->min_withdraw) return response()->json(['success' => false, 'message' => 'Минимальная сумма вывода '.$this->config->min_withdraw.' руб.']);
        if ($openBox < $this->config->min_box_withdraw) return response()->json(['success' => false, 'message' => 'Откройте '.$this->config->min_box_withdraw.' кейсов для вывода средств.']);
        if ($this->user->balance < $amount) return response()->json(['success' => false, 'message' => 'У вас не достаточно средств.']);
        $this->user->update([
            'balance' => $this->user->balance - $amount
        ]);
        Withdraw::create([
            'payway' => $payway,
            'amount' => $amount,
            'status' => 0,
            'user_id' => $this->user->id
        ]);
        Redis::publish('balance', json_encode($this->user));
        return response()->json([
            'success' => true,
            'message' => 'Запрос на вывод отправлен!'
        ]);
    }

    /*
     * Создание платежки
     */
    public function createPayment(Request $r)
    {
        $amount = $r->amount;
        $payway = $r->payway;
        // Данные магазинов
        $payment = $this->config->payment;
        $shop_id_paytrio = $this->config->shop_id_paytrio;
        $secret_word_paytrio = $this->config->secret_word_paytrio;
        $shop_id_freekassa = $this->config->shop_id_freekassa;
        $secret_word_freekassa = $this->config->secret_word_freekassa;
        $order = Order::create([
            'user_id' => $this->user->id,
            'amount' => $amount
        ]);
        if ($payment == 'pay-trio') {
            $sign = md5($amount.':643:'.$payway.':'.$shop_id_paytrio.$secret_word_paytrio);
            return response()->json([
                'amount' => $amount,
                'currency' => 643,
                'shop_id' => $shop_id_paytrio,
                'sign' => $sign,
                'description' => 'Пополнение баланса на сайте '.$this->config->namesite,
                'shop_invoice_id"' => $order->id,
                'payway' => $payway,
                'payment' => $payment
            ]);
        } else if ($payment == 'freekassa') {
            $sign = md5($shop_id_freekassa.':'.$amount.':'.$secret_word_freekassa.':'.$order->id);
            if ($payway == 'card_rub') $pay_way = 94;
            if ($payway == 'qiwi_rub') $pay_way = 63;
            if ($payway == 'yamoney_rub') $pay_way = 45;
            if ($payway == 'mts_rub') $pay_way = 84;
            if ($payway == 'megafon_rub') $pay_way = 82;
            if ($payway == 'beeline_rub') $pay_way = 83;
            if ($payway == 'tele2_rub') $pay_way = 132;
            return response()->json([
                'merchant_id' => $shop_id_freekassa,
                'amount' => $amount,
                'order_id' => $order->id,
                'sign' => $sign,
                'login' => $this->user->id,
                'pay_way' => $pay_way,
                'payment' => $payment
            ]);
        }
        die();
    }

    /*
     * Принимаем платежку pay-trio
     */
    public function paytrio(Request $r)
    {
        if (!in_array($this->getIP(), array('51.254.21.174', '188.227.174.150'))) {
            die("hacking attempt!");
        }
        $secret_word_paytrio = $this->config->secret_word_paytrio;
        $order = Order::where('id', $r->shop_invoice_id)->where('status', 0)->first();
        if (is_null($order)) {
            die('Order not found');
        }
        if ($r->status == 4) {
            $order->update([
                'status' => 2
            ]);
            die('Not pay order');
        }
        $user = User::where('id', $order->user_id)->first();
        if (is_null($user)) die('User not found');
        $user->update([
            'balance' => $user->balance + $order->amount
        ]);
        $order->update([
            'status' => 1
        ]);
        if (is_null($user->affiliate_use)) die('Code not found, order accept!');
        $refer = User::where('affiliate_code', $user->affiliate_use)->first();
        if (is_null($refer)) die('Refer not found');
        $money = ($order->amount * 5) / 100;
        $refer->update([
            'balance' => $refer->balance + $money,
            'affiliate_profit' => $refer->affiliate_profit + $money
        ]);
        die('Accept order, accept code');
    }

    /*
     * Принимаем платежку freekassa
     */
    public function freekassa(Request $r)
    {
        if (!in_array($this->getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98'))) {
            die("hacking attempt!");
        }
        $secret_word_freekassa = $this->config->secret_word_freekassa;
        $sign = md5($r->MERCHANT_ID.':'.$r->AMOUNT.':'.$secret_word_freekassa.':'.$r->MERCHANT_ORDER_ID);
        $order = Order::where('id', $r->MERCHANT_ORDER_ID)->where('status', 0)->first();
        if (is_null($order)) {
            die('Order not found');
        }
        $user = User::where('id', $order->user_id)->first();
        if (is_null($user)) die('User not found');
        $user->update([
            'balance' => $user->balance + $order->amount
        ]);
        $order->update([
            'status' => 1
        ]);
        if (is_null($user->affiliate_use)) die('Code not found, order accept!');
        $refer = User::where('affiliate_code', $user->affiliate_use)->first();
        if (is_null($refer)) die('Refer not found');
        $money = ($order->amount * 5) / 100;
        $refer->update([
            'balance' => $refer->balance + $money,
            'affiliate_profit' => $refer->affiliate_profit + $money
        ]);
        die('Accept order, accept code');
    }

    /*
     * Проверяем IP
     */
    function getIP() {
        if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

}