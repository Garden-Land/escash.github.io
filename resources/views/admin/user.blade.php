@extends('admin.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="profile-detail card-box">
                            <div>
                                <img src="{{$user->avatar}}" class="img-circle" alt="profile-image">

                                <h4>{{$user->name}}</h4>

                                <ul class="list-inline status-list m-t-20">
                                    <li>
                                        <h3 class="text-primary m-b-5">{{$user->open_box}}</h3>
                                        <p class="text-muted">Открыл кейсов</p>
                                    </li>

                                    <li>
                                        <h3 class="text-success m-b-5">{{$user->open_sum}}</h3>
                                        <p class="text-muted">Выиграл</p>
                                    </li>
                                </ul>

                                @if($user->profile == 'vk')
                                    <a href="https://vk.com/id{{$user->user_id}}" target="_blank">
                                        @else
                                            <a href="http://steamcommunity.com/profiles/{{$user->user_id}}/"
                                               target="_blank">
                                                @endif
                                                <button type="button"
                                                        class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">
                                                    Профиль
                                                </button>
                                            </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/saveUser" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Имя пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$user->name}}" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Аватарка пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$user->avatar}}" name="avatar">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на профиль</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$user->user_id}}" name="user_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Баланс пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$user->balance}}" name="balance">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Реферальный код пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{$user->affiliate_code}}" name="affiliate_code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Использованный реферальный код</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{$user->affiliate_use}}" name="affiliate_use">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получил от рефералов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{$user->affiliate_profit}}" name="affiliate_profit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Открыл кейсов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{$user->open_box}}" name="open_box">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получил с кейсов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="{{$user->open_sum}}" name="open_sum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Роль</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" required name="role">
                                            @if($user->role == 'user')
                                                <option value="user">Пользователь</option>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="admin">Администратор</option>
                                                <option value="fake">Фейк</option>
                                            @elseif($user->role == 'youtuber')
                                                <option value="youtuber">Ютубер</option>
                                                <option value="user">Пользователь</option>
                                                <option value="admin">Администратор</option>
                                                <option value="fake">Фейк</option>
                                            @elseif($user->role == 'fake')
                                                <option value="fake">Фейк</option>
                                                <option value="admin">Администратор</option>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="user">Пользователь</option>
                                            @elseif($user->role == 'admin')
                                                <option value="admin">Администратор</option>
                                                <option value="fake">Фейк</option>
                                                <option value="youtuber">Ютубер</option>
                                                <option value="user">Пользователь</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Зарегистрирован</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" disabled value="{{$user->created_at}}">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                        <button type="submit" class="btn btn-primary">
                                            Сохранить
                                        </button>
                                        <button type="reset" class="btn btn-default m-l-5">
                                            Отмена
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection