@extends('adminlte::page')

@section('title', config('app.name', 'BizPlace'))

@section('content_header')
    <h1>Просмотр сотрудника</h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
        <li><a href="/personal"> Сотрудники</a></li>
        <li class="active"> Просмотр специалиста</li>
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
                    <h3 class="box-title">Данные сотрудника</h3>
                </div><!-- /.box-header -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{action('PersonalController@storePerson')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="isUpdate" value="1">
                    <input type="hidden" name="person_id" value="{{ $person->id }}">
                    <input type="hidden" name="user_id" value="{{ $person->user_id }}">
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
                                            <label for="person_name">Специалист</label>
                                            <input type="text" class="form-control" id="person_name" name="person_name" value="{{ $person->person_name }}">
                                            @if ($errors->has('person_name'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('person_name') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <label for="description">Описание и характеристика сотрудника</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Введите описание сотрудника" rows="3">{{ $person->description }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('description') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <label>Укажите специализацию</label>
                                            <select id="speciality_id" name="speciality_id" class="form-control" name="speciality_id">
                                                @foreach($specialities as $speciality)
                                                    @if ($speciality->id == $person->speciality_id)
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
                                        <div class="form-group col-xs-12">
                                            <label>Укажите уровень специалиста</label>
                                            <select id="skill_id" name="skill_id" class="form-control" name="skill_id">
                                                <option value="0">Выберите уровень</option>
                                                @foreach($skills as $skill)
                                                    @if ($skill->id == $person->skill_id)
                                                        <option selected value="{{$skill->id}}">{{$skill->name}}</option>
                                                    @else
                                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('skill_id'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('skill_id') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <label for="experience">Опыт</label>
                                            <input type="text" class="form-control" id="experience" name="experience" value="{{ $person->experience }}" onkeyup="this.value = this.value.replace (/\D/g, '')">
                                            @if ($errors->has('experience'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('experience') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="hour_rate">Часовая ставка</label>
                                            <input type="text" class="form-control" id="hour_rate" name="hour_rate" value="{{ $person->hour_rate }}" onkeyup="this.value = this.value.replace (/\D/g, '')">
                                            @if ($errors->has('hour_rate'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('hour_rate') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>
                                       
                                        <div class="form-group col-xs-12">
                                            <p class="form-control-static">
                                                @if ($person->resume)
                                                    Резюме <span class="label label-success">Есть!&nbsp;</span>
                                                        <a href="{{ isset($person->resume) ? Storage::url($person->resume) : '' }}">Посмотреть</a>
                                                @endif
                                                <br>
                                                <label for="resume">Заменить резюме <small>(pdf, rtf, doc)</small></label>
                                                <input id="resume" type="file" name="resume" value="{{ $person->resume }}" accept="*.pdf,*.rtf,*.doc">
                                            </p>

                                            @if ($errors->has('resume'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('resume') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-xs-6">
                                            <label for="free_since">Свободен с</label>
                                            <input type="text" class="form-control" id="free_since" name="free_since" value="{{ $person->free_since }}">
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
                                                    <input type="checkbox" id="active" name="active" {{ $person->active ? 'checked' : ''}} value="1">&nbsp;Показать на сайте</label>
                                            </div>
                                            @if ($errors->has('active'))
                                                <span class="text-danger">
                                                    <strong><small>{{ $errors->first('active') }}</small></strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="box-footer clearfix">
                                        <a href="{{ Redirect::back()->getTargetUrl() }}"><button type="button" class="btn btn-default">Отмена</button></a>
                                        <button type="submit" class="btn btn-info pull-right" onclick="document.getElementById('preloader').style.display = 'block'">Сохранить изменения</button>
                                    </div>
                                </div>
                            </div>
                            <!-- right column -->
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Технологии, которыми владеет специалист</h3>
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
                                                        @if($loop->iteration % 3 == 1)
                                                            <tr>
                                                        @endif
                                                            <td><input type="checkbox" id="technology{{$technology->id}}" name="technologies[{{$technology->id}}]" {{ in_array($technology->id, (array) $person->technologies) ? 'checked' : ''}} value="{{ $technology->id }}"></td>
                                                            <td class="mailbox-name">{{ $technology->name }}</td>
                                                        @if($loop->iteration % 3 == 0)
                                                            <tr>
                                                        @endif
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
                </form>
                <div class="overlay" id="preloader" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
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