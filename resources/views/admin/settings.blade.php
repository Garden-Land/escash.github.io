@extends('admin.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/admin/saveSettings">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Настройки сайта</b></h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="p-20">
                                            <h5><b>Название сайта</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Указывается без http, например: EsCash.net
                                            </p>
                                            <input type="text" value="{{$config->namesite}}" class="form-control" maxlength="25" name="namesite">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Сумма за реферальный код</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Когда пользователь активирует код, то он получит:
                                            </p>
                                            <input type="number" value="{{$config->ref_sum}}" class="form-control" maxlength="25" name="ref_sum">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Минимальная сумма вывода</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Минимальная сумма вывода
                                            </p>
                                            <input type="number" value="{{$config->min_withdraw}}" class="form-control" maxlength="25" name="min_withdraw">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Сумма открытий для вывода</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Сколько нужно открыть пользователю кейсов, чтобы сделать заявку на вывод
                                            </p>
                                            <input type="number" value="{{$config->min_box_withdraw}}" class="form-control" maxlength="25" name="min_box_withdraw">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="p-20">
                                            <h5><b>Shop ID Оплаты Pay-Trio</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Shop ID с платежки Pay-Trio
                                            </p>
                                            <input type="number" value="{{$config->shop_id_paytrio}}" class="form-control" maxlength="25" name="shop_id_paytrio">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Secret Word Оплаты Pay-Trio</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Secret Word с платежки Pay-Trio
                                            </p>
                                            <input type="text" value="{{$config->secret_word_paytrio}}" class="form-control" maxlength="25" name="secret_word_paytrio">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Shop ID Оплаты FreeKassa</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Shop ID с платежки Pay-Trio
                                            </p>
                                            <input type="number" value="{{$config->shop_id_freekassa}}" class="form-control" maxlength="25" name="shop_id_freekassa">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Secret Word Оплаты FreeKassa</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Secret Word с платежки Pay-Trio
                                            </p>
                                            <input type="text" value="{{$config->secret_word_freekassa}}" class="form-control" maxlength="25" name="secret_word_freekassa">
                                        </div>
                                        <div class="p-20">
                                            <h5><b>Платежная система</b></h5>
                                            <p class="text-muted m-b-15 font-13">
                                                Выберите систему, с помощью которой люди будут вносить деньги
                                            </p>
                                            <select class="form-control select2" name="payment">
                                                @if($config->payment == 'freekassa')
                                                    <option value="freekassa">FreeKassa</option>
                                                    <option value="pay-trio">Pay-Trio</option>
                                                @else
                                                    <option value="pay-trio">Pay-Trio</option>
                                                    <option value="freekassa">FreeKassa</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-purple waves-effect waves-light">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection