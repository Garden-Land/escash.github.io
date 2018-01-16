<?php
/**
 * Created by PhpStorm.
 * User: ToXaHo
 * Date: 24.04.2017
 * Time: 23:53
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'namesite', 'ref_sum', 'min_withdraw', 'min_box_withdraw', 'payment', 'shop_id_paytrio', 'secret_word_paytrio', 'shop_id_freekassa', 'secret_word_freekassa'
    ];
}
