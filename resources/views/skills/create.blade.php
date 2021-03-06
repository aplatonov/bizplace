@extends('adminlte::page')

@section('title', config('app.name', 'BizPlace'))

@section('content_header')
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
        <li><a href="##"> Администратор</a></li>
        <li><a href="/skills"> Уровни</a></li>
        <li class="active"> Добавление уровня</li>
    </ol>
@stop

@section('content')
    <div class="row>">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавление уровня</h3>
                </div><!-- /.box-header -->
                <form role="form" method="POST" action="{{route('skills.store')}}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="name">Название</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('name') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <div class="checkbox">
                                                <label for="active">
                                                    <input type="checkbox" id="active" name="active" {{ old('active') ? 'checked' : ''}} value="1">
                                                    Активно
                                                </label>
                                                @if ($errors->has('active'))
                                                    <span class="text-danger">
                                                        <strong><small>{{ $errors->first('active') }}</small></strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ route('skills.index') }}"><button type="button" class="btn btn-default">Отмена</button></a>
                        <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop
