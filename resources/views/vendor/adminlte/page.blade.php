@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">За последние сутки у вас 10 новых объектов</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                      <li>
                                        <a href="#">
                                          <i class="fa fa-bookmark text-aqua"></i> 5 компаний зарегистрировано
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <i class="fa fa-gears text-yellow"></i> 3 проекта добавлено</i> 
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <i class="fa fa-users text-red"></i> 15 новых специалистов
                                        </a>
                                      </li>

                                      <li>
                                        <a href="#">
                                          <i class="fa fa-mail-forward text-green"></i> 25 запросов контактной информации
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <i class="fa fa-comments text-red"></i> 4 новых отзыва
                                        </a>
                                      </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/img/noname.png" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                              <!-- User image -->
                              <li class="user-header">
                                <img src="/img/noname.png" class="img-circle" alt="User Image">
                                <p>
                                  {{ Auth::user()->name }}<br>{{ Auth::user()->contact_person}}
                                  <small>{{ isset(Auth::user()->created_at) ? 'зарегистрирован ' . Carbon\Carbon::parse(Auth::user()->created_at)->format('d-m-Y') : '' }}</small>
                                </p>
                              </li>
                              <!-- Menu Body -->
                              <li class="user-body">
                                <div class="row">
                                  <div class="col-xs-4 text-center">
                                    <a href="#">Проекты</a>
                                  </div>
                                  <div class="col-xs-4 text-center">
                                    <a href="#">Спец-ты</a>
                                  </div>
                                  <div class="col-xs-4 text-center">
                                    <a href="#">Сообщен.</a>
                                  </div>
                                </div>
                                <!-- /.row -->
                              </li>
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                <div class="pull-left">
                                  <a href="/users/{{ Auth::user()->id }}/edit" class="btn btn-default btn-flat">Профиль</a>
                                </div>
                                <div class="pull-right">
                                    <!--a href="#" class="btn btn-default btn-flat">Выход</a-->
                                    @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                        <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-flat">
                                        {{ trans('adminlte::adminlte.log_out') }}
                                        </a>
                                    @else
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                        {{ trans('adminlte::adminlte.log_out') }}</a>
                                        <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                        @if(config('adminlte.logout_method'))
                                            {{ method_field(config('adminlte.logout_method')) }}
                                        @endif
                                        {{ csrf_field() }}
                                        </form>
                                    @endif
                                </div>
                              </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="row">
                <div class="col-md-3">
                  <img class="img-responsive" src="/img/logo_full.png" alt="BizPlace logo">
                  <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Тарифы</a></li>
                        <li><a href="#">Отзывы</a></li>
                    </ul>
                </div>
                <!-- ./col -->
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><a href="/home">Как это работает</a></li>
                        <li><a href="#">Наши контакты</a></li>
                        <li><a href="#">Политика конфеденциальности</a></li>
                    </ul>
                </div>
                <!-- ./col -->
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><button type="button" class="btn btn-block btn-default btn-xs">Связаться с нами</button></li>
                        <li>&nbsp;</li>
                        <li><button type="button" class="btn btn-block btn-default btn-xs">Позвоните нам</button></li>
                    </ul>
                </div>
                <!-- ./col -->
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/app.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
