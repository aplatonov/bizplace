@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>Политика конфиденциальности</h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> BizPlace</a></li>
    <li class="active"> Политика конфиденциальности</li>
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

    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>&nbsp;</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                {!! nl2br($settings->konfedential) !!}
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
   
    
</div>
<!-- /.row -->
@stop
