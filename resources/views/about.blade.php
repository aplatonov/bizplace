@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>О нас</h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> BizPlace</a></li>
    <li class="active"> О нас</li>
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
                <h4>&nbsp;</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                {!! nl2br($settings->about_us_1) !!}
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>&nbsp;</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                {!! nl2br($settings->about_us_2) !!}
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
    <div class="col-xs-4">
        <div class="box box-primary">
            <div class="box-header box-profile">
                <h4>&nbsp;</h4>
            </div> <!-- /.box-header -->

            <div class="box-body">
                {!! nl2br($settings->about_us_3) !!}
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
    
</div>
<!-- /.row -->
@stop
