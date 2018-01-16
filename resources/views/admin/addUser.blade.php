@extends('admin.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/addUserPost" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Имя пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="Соболь Антон" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Аватарка пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="https://pp.userapi.com/c629521/v629521692/595df/mDHt_JClOaY.jpg" name="avatar">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на профиль</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="327272692" name="user_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Баланс пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="0" name="balance">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Реферальный код пользователя</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="FREE" name="affiliate_code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Использованный реферальный код</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="FREE" name="affiliate_use">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получил от рефералов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="0" name="affiliate_profit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Открыл кейсов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="0" name="open_box">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получил с кейсов</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="0" name="open_sum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Роль</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" required name="role">
                                            <option value="fake">Фейк</option>
                                            <option value="user">Пользователь</option>
                                            <option value="youtuber">Ютубер</option>
                                            <option value="admin">Администратор</option>
                                        </select>
                                    </div>
                                </div>
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