@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
    <h1>Страница приветствия</h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
        <li class="active"> Страница приветствия</li>
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

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Горячие предложения</h3>
                </div> <!-- /.box-header -->
                <div class="box-body">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="http://placehold.it/900x510/39CCCC/ffffff&text=BizPlace!" alt="First slide">
                                <div class="carousel-caption">
                                    Первый слайд
                                </div>
                            </div>
                            <div class="item">
                                <img src="http://placehold.it/900x510/3c8dbc/ffffff&text=Размещайте проекты!" alt="Second slide">
                                <div class="carousel-caption">
                                    Второй слайд
                                </div>
                            </div>
                            <div class="item">
                                <img src="http://placehold.it/900x510/f39c12/ffffff&text=Берите заказы!" alt="Third slide">
                                <div class="carousel-caption">
                                    Третий слайд
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
			<div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Краткие правила</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Без регистрации</dt>
                <dd>Доступна общая информация о системе</dd>
                <dd>Вы можете ознакомится с документацией</dd>
                <dt>&nbsp;</dt>
                <dd>&nbsp;</dd>
                <dd><strong>Для входа в систему необходимо зарегистрироваться</strong></dd>
                <dt>По умолчанию</dt>
                <dd>Вновь зарегистрированный пользователь должен быть подтвержден администратором</dd>
                <dd>До этого доступен просмотр списка проектов, компаний и специалистов и написание сообщений администратору</dd>
                <dd>Подробно заполните свой профиль</dd>
                <dt>После активации</dt>
                <dd>Вы сможете добавлять проекты и специалистов, получать о них информацию</dd>
                <dd>Получать и писать отзывы, получать оповещения</dd>
                <dt>&nbsp;</dt>
                <dd>&nbsp;</dd>
                <dd>На время тестирования системы</dd>
                <dt>Вход администратора</dt>
                <dd><span class="label label-primary">admin/admin</span></dd>
                <dt>Вход пользователя</dt>
                <dd><span class="label label-primary">user/user</span></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@stop