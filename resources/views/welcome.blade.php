@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-primary">
                <div class="panel-heading">О нас</div>

                <div class="panel-body">
                    <p>Для входа в систему необходимо зарегистрироваться.<br><br>
                    Вторая версия систем. Реализовано: <br>
                    <span class="badge">1</span> Регистрация пользователей, редактирование профиля<br>
                    <span class="badge">2</span> Управление администратором списком пользователей<br>
                    <span class="badge">3</span> Управление специалистами (список, карточка, редактирование, поиск, сортировка)<br>
                    <span class="badge">4</span> Управление проектами (список, карточка, редактирование, поиск, сортировка)<br>
                    <span class="badge">5</span> Мои специалисты/Мои проекты<br>
                    <hr>
                    Логин/пароль администратора: <span class="label label-primary">admin/admin</span><br>
                    Логин/пароль пользователя: <span class="label label-info">user/user</span><br>
                    </p>
                </div>
            </div>
        </div>

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
</div>
@endsection
