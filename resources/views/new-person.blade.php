@extends('adminlte::page')

@section('title', config('app.name', 'BizPlace'))

@section('content_header')
    <h1>Новый сотрудник</h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
        <li><a href="#"> Личный кабинет</a></li>
        <li class="active"> Добавить специалиста</li>
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
                    <h3 class="box-title">Заполните данные сотрудника</h3>
                </div><!-- /.box-header -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{action('PersonalController@storePerson')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="isUpdate" value="0">
                    <input type="hidden" name="user_id" value="{{ $form['user_id'] }}">
                    <div class="box-body">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Основная информация</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group col-xs-12">
                                            <label for="person_name">Название сотрудника</label>
                                            <input type="text" class="form-control" id="person_name" name="person_name" value="{{ old('person_name') }}">
                                            @if ($errors->has('person_name'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('person_name') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <label for="description">Описание и характеристика сотрудника</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Введите описание сотрудника" rows="3">{{ old('description') }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('description') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <label>Укажите специализацию</label>
                                            <select id="speciality_id" name="speciality_id" class="form-control" name="speciality_id">
                                                <option value="0">Выберите специализацию</option>
                                                @foreach($specialities as $speciality)
                                                    @if ($speciality->id == old('speciality_id'))
                                                        <option selected value="{{$speciality->id}}">{{$speciality->name}}</option>
                                                    @else
                                                        <option value="{{$speciality->id}}">{{$speciality->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('speciality_id'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('speciality_id') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <label for="experience">Опыт</label>
                                            <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}" onkeyup="this.value = this.value.replace (/\D/g, '')">
                                            @if ($errors->has('experience'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('experience') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="hour_rate">Часовая ставка</label>
                                            <input type="text" class="form-control" id="hour_rate" name="hour_rate" value="{{ old('hour_rate') }}" onkeyup="this.value = this.value.replace (/\D/g, '')">
                                            @if ($errors->has('hour_rate'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('hour_rate') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                       
                                        <div class="form-group col-xs-12">
                                            <label for="resume">Резюме <small>(pdf, rtf, doc)</small></label>
                                            <input id="resume" type="file" name="resume" value="{{ old('resume') }}" accept="*.pdf,*.rtf,*.doc">
                                            @if ($errors->has('resume'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('resume') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <label for="free_since">Свободен с</label>
                                            <input type="text" class="form-control" id="free_since" name="free_since" value="{{ old('free_since') }}">
                                            @if ($errors->has('free_since'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('free_since') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <div class="checkbox">
                                                <br>
                                                <label for="active">
                                                    <input type="checkbox" id="active" name="active" {{ old('active') ? 'checked' : ''}} value="1">&nbsp;Показать на сайте</label>
                                            </div>
                                            @if ($errors->has('active'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('active') }}</small></strong>
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
                                        <h3 class="box-title">Укажите технологии, которыми владеет специалист</h3>
                                        @if ($errors->has('technologies'))
                                            <br>
                                            <span class="text-danger">
                                                    <strong><small>{{ $errors->first('technologies') }}</small></strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="box-body">
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped table-condensed">
                                                <tbody>
                                                    @forelse($technologies as $technology)
                                                        <tr>
                                                            <td><input type="checkbox" id="technology{{$technology->id}}" name="technologies[{{$technology->id}}]" {{ in_array($technology->id, (array) old('technologies')) ? 'checked' : ''}} value="{{ $technology->id }}"></td>
                                                            <td class="mailbox-name">{{ $technology->name }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td span="4">Не внесены технологии</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <!-- /.table -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right column END -->
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ Redirect::back()->getTargetUrl() }}"><button type="button" class="btn btn-default">Отмена</button></a>
                        <button type="submit" class="btn btn-info pull-right">Сохранить сотрудника</button>
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
