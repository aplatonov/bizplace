@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>Редактирование профиля</h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> Личный кабинет</a></li>
    <li class="active"> Редактирование профиля</li>
</ol>
@stop

@section('content')
<div class="row">
    @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              {{Session::get('message')}}
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Редактирование профиля <strong>{{ $user->login }}</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ action('UserController@update', ['user'=>$user->id]) }}">
                <div class="box-body">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-sm-4 control-label">E-Mail</label>
                        <div class="col-sm-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-4 control-label">Имя (наименование)</label>
                        <div class="col-sm-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                        <label for="contact_person" class="col-sm-4 control-label">Контактное лицо</label>
                        <div class="col-sm-6">
                            <input id="contact_person" type="text" class="form-control" name="contact_person" value="{{ $user->contact_person }}" required>
                            @if ($errors->has('contact_person'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_person') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-sm-4 control-label">Телефон</label>
                        <div class="col-sm-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('www') ? ' has-error' : '' }}">
                        <label for="www" class="col-sm-4 control-label">www</label>
                        <div class="col-sm-6">
                            <input id="www" type="text" class="form-control" name="www" value="{{ $user->www }}" placeholder="http://mysite.com">
                            @if ($errors->has('www'))
                            <span class="help-block">
                                <strong>{{ $errors->first('www') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('portfolio') ? ' has-error' : '' }}">
                        <label for="portfolio" class="col-sm-4 control-label">Портфолио <small>(pdf, rtf, doc)</small></label>
                        <div class="col-sm-6">
                            <p class="form-control-static">
                                @if ($user->portfolio)
                                    <span class="label label-success">Есть!&nbsp;</span>
                                    <a href="{{ isset($user->portfolio) ? Storage::url($user->portfolio) : '' }}">Посмотреть</a><br><label class="control-label">Заменить портфолио:</label>
                                @endif
                                <input id="portfolio" type="file" name="portfolio" value="{{ old('portfolio') }}" accept=".pdf,.doc,.docx,.rtf">
                            </p>
                            @if ($errors->has('portfolio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('portfolio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                        <label for="logo" class="col-sm-4 control-label">Логотип <small>(jpg, png ,jpeg, gif)</small></label>
                        <div class="col-sm-6 text-center">
                           
                            <div class="center-block" style="width: 220px; height: 220px; margin-bottom: 5px;">
                                <img src="{{ isset($user->logo) ? Storage::url($user->logo) : '/img/noname.png' }}" id="img" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                <input type="file" name="logo" id="logo" accept=".jpg,.png,.jpeg,.gif" style="display: none; ">
                            </div>
                            <a href="##" id="browse_file" onclick="return false;">Добавить логотип</a>
                            
                            @if ($errors->has('logo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @if (Auth::user()->isAdmin())
                        <div class="form-group{{ $errors->has('pay_till') ? ' has-error' : '' }}">
                            <label for="pay_till" class="col-sm-4 control-label">Оплачено до</label>
                            <div class="col-sm-6">
                                <input id="pay_till" type="text" class="form-control input-sm" name="pay_till" value="{{ isset($user->pay_till) ? Carbon\Carbon::parse($user->pay_till)->format('Y-m-d') : '' }}">

                                @if ($errors->has('pay_till'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pay_till') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Оплата до</label>
                            <div class="col-sm-6">
                                <p class="form-control-static">{{ isset($user->pay_till) ? Carbon\Carbon::parse($user->pay_till)->format('Y-m-d') : '' }}</p>
                            </div>
                        </div>
                    @endif    

                    @if (!Auth::guest() && Auth::user()->confirmed == 0)
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <label class="col-sm-6 control-label"><span class="badge badge-important">Логин не подтвержден!</span><br><small>Вы не можете добавлять объекты и просматривать контактные данные</small>
                        </div>
                    @endif
                    @if (!Auth::guest() && Auth::user()->valid == 0)
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <label class="col-sm-6 control-label"><span class="badge badge-warning">Логин заблокирован!</span><br><small>обратитесь к администратору</small></label>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/home') }}"><button type="button" class="btn btn-default">Отмена</button></a>
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
            <!-- /.box-footer -->
        </form>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@stop

@section('jscripts')
    <script type="text/javascript">
        $(function () {
          $('#pay_till').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            autoClose: true
        });
      });
    </script>

    <script>
        $('#browse_file').on('click', function(e){
            $('#logo').click();
        });
        $('#logo').on('change', function(e){
            var fileInput = this;
            if (fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('#img').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>
    <script>
        jQuery(function($){
            $("#phone").mask("+7 (999) 999-99-99", {placeholder:"x"});
        });
    </script>
@endsection