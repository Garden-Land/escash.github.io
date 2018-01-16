@extends('admin.layout')

@section('content')
    <script src="/adminAsset/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="profile-detail card-box">
                            <div>
                                <img src="{{$case->img}}" class="img-circle" alt="profile-image">

                                <h4>{{$case->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/saveCase" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Название кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$case->name}}" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Стоимость кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$case->price}}" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Получили с кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$case->total_given}}" name="total_given">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на изображение</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" value="{{$case->img}}" name="img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Предметы в кейсе</label>
                                    <div class="col-sm-6">
                                        <select class="select2 select2-multiple" multiple="multiple" multiple name="items[]" data-placeholder="Выберите предметы ...">
                                            @if($case->items == '' || $case->items == 'null')
                                                @foreach ($items as $item)
                                                        <option value="{{$item->id}}">{{$item->sell_price}} р.</option>
                                                @endforeach
                                            @else
                                                @foreach ($items as $item)
                                                    @foreach($itemsCase as $itemCase)
                                                        @if ($item->id == $itemCase)
                                                            <option selected value="{{$item->id}}">{{$item->sell_price}} р.</option>
                                                        @endif
                                                    @endforeach
                                                        <option value="{{$item->id}}">{{$item->sell_price}} р.</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$case->id}}">
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