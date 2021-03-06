@extends('adminlte::page')

@section('title', config('app.name', 'BizPlace'))

@section('content_header')
    <h1>Настройка системы</h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
        <li><a href="/settingsal"> Администратор</a></li>
        <li class="active"> Настройка</li>
    </ol>
@stop

@section('content')
    <div class="row>">
        @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              {{Session::get('message')}}
            </div>
        </div>
        @endif
         <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Настройка информации в разделах</h3>
                </div><!-- /.box-header -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{action('SettingsController@store')}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Раздел: "Как это работает"</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="how_it_works_1">Столбец 1</label>
                                            <textarea name="how_it_works_1" id="how_it_works_1" class="form-control" placeholder="Описание работы системы для отображения в 1-м столбце" rows="4">{{ $settings->how_it_works_1 }}</textarea>

                                            @if ($errors->has('how_it_works_1'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('how_it_works_1') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="how_it_works_2">Столбец 2</label>
                                            <textarea name="how_it_works_2" id="how_it_works_2" class="form-control" placeholder="Описание работы системы для отображения во 2-м столбце" rows="4">{{ $settings->how_it_works_2 }}</textarea>

                                            @if ($errors->has('how_it_works_2'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('how_it_works_2') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="how_it_works_3">Столбец 3</label>
                                            <textarea name="how_it_works_3" id="how_it_works_3" class="form-control" placeholder="Описание работы системы для отображения в 3-м столбце" rows="4">{{ $settings->how_it_works_3 }}</textarea>

                                            @if ($errors->has('how_it_works_3'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('how_it_works_3') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Раздел: "Контакты"</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="how_contact_us">Как связаться с компанией</label>
                                            <textarea name="how_contact_us" id="how_contact_us" class="form-control" placeholder="Описание как связаться с компанией" rows="3">{{ $settings->how_contact_us }}</textarea>

                                            @if ($errors->has('how_contact_us'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('how_contact_us') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="address">Адрес</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address }}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('address') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="phone">Телефон</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $settings->phone }}">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('phone') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="email">E-mail</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ $settings->email }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('email') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="regime">Режим работы</label>
                                            <input type="text" class="form-control" id="regime" name="regime" value="{{ $settings->regime }}">
                                            @if ($errors->has('regime'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('regime') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right column -->
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Раздел: "О нас"</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="about_us_1">Столбец 1</label>
                                            <textarea name="about_us_1" id="about_us_1" class="form-control" placeholder="Текст для отображения в 1-м столбце" rows="3">{{ $settings->about_us_1 }}</textarea>

                                            @if ($errors->has('about_us_1'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('about_us_1') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="about_us_2">Столбец 2</label>
                                            <textarea name="about_us_2" id="about_us_2" class="form-control" placeholder="Текст для отображения во 2-м столбце" rows="3">{{ $settings->about_us_2 }}</textarea>

                                            @if ($errors->has('about_us_2'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('about_us_2') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="about_us_3">Столбец 3</label>
                                            <textarea name="about_us_3" id="about_us_3" class="form-control" placeholder="Текст для отображения в 3-м столбце" rows="3">{{ $settings->about_us_3 }}</textarea>

                                            @if ($errors->has('about_us_3'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('about_us_3') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Раздел: "Конфиденциальность"</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="konfedential">Соглашение о конфиденциальности</label>
                                            <textarea name="konfedential" id="konfedential" class="form-control" placeholder="Текст соглашения о конфиденциальности" rows="6">{{ $settings->konfedential }}</textarea>

                                            @if ($errors->has('konfedential'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('konfedential') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right column END -->
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ Redirect::back()->getTargetUrl() }}"><button type="button" class="btn btn-default">Отмена</button></a>
                        <button type="submit" class="btn btn-info pull-right">Сохранить изменения</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('jscripts')
    <script type="text/javascript">
        $(function () {
          $('#free_since').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            autoClose: true
        });
      });
    </script>
@endsection