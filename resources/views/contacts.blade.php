@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>Наши контакты</h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> BizPlace</a></li>
    <li class="active"> Наши контакты</li>
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

    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>Как связаться с компанией</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                </p>
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>Наши контакты</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                <strong><i class="fa fa-home margin-r-5"></i>Адрес</strong>
                <p class="text-muted">г. Ульяновск, Московское шоссе, 108, ТЦ Аквамолл</p>
                <strong><i class="fa fa-phone margin-r-5"></i>Телефон</strong>
                <p class="text-muted">(8422) 279727</p>
                <strong><i class="fa fa-envelope-o margin-r-5"></i>e-mail</strong>
                <p class="text-muted">coral-ul@coralvolga.ru</p>
                <strong><i class="fa fa-clock-o margin-r-5"></i>Режим работы</strong>
                <p class="text-muted">Понедельник-воскресенье: 10:00-21:00</p>
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>Остались вопросы?</h4>
            </div> <!-- /.box-header -->
            <form role="form" method="POST" action="{{action('HomeController@sendFeedback')}}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-xs-12">
                        <input type="text" class="form-control" id="person_name" name="person_name" value="{{ old('person_name') }}" placeholder="Ваше имя" required>
                        @if ($errors->has('person_name'))
                            <span class="text-danger">
                                <strong><small>{{ $errors->first('person_name') }}</small></strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-xs-12">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong><small>{{ $errors->first('email') }}</small></strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-xs-12">
                        <textarea name="description" id="description" class="form-control" placeholder="Сообщение" rows="3" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">
                                <strong><small>{{ $errors->first('description') }}</small></strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div> <!-- /.box-body -->
            <div class="box-footer clearfix">
                <button type="submit" class="btn btn-info pull-right">Отправить сообщение</button>
            </div>
            </form>
        </div> <!-- /.box -->
    </div>
    
</div>
<!-- /.row -->
@stop
