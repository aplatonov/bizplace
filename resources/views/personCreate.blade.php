@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>Добавление сотрудника</h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> Личный кабинет</a></li>
    <li class="active"> Добавить специалиста</li>
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
                <h3 class="box-title">Добавить специалиста <strong>{{ Auth::user()->name }}</strong></h3>
            </div> <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
                ТУТ БУДЕТ ФОРМА ДОБАВЛЕНИЯ ПОЛЬЗОВАТЕЛЯ
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url('/home') }}"><button type="button" class="btn btn-default">Отмена</button></a>
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
            <!-- /.box-footer -->
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
          $('#free_since').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            autoClose: true
        });
      });
    </script>
@endsection