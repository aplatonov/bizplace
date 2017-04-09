@extends('adminlte::page')

@section('title', 'BizPlace')

@section('content_header')
<h1>Специалисты <small>{{ isset($data['title']) ? $data['title'] : ''}}</small></h1>
<ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Главное меню</a></li>
    <li><a href="#"> BizPlace</a></li>
    <li class="active"> Специалисты</li>
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
        <div class="box">
            <div class="box-header">
                <form method="GET" action="{{ url('/personal/add') }}" id="addPersonalForm" style="display:none;">
                    <input type="hidden" name="fromPage" value="{{ Route::current()->getName() }}" id="fromPage">
                </form>
                <button class="btn btn-primary btn-sm pull-left" type="submit" onclick = "document.getElementById('addPersonalForm').submit();"><i class="fa fa-user-plus pull-left"></i>Добавить сотрудника</button>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <form method="GET" action="{{ Route::current()->getName() }}" id="searchForm" style="display:none;">
                            <input type="hidden" name="searchText" value="{{ Request::get('searchText') }}" id="searchText">
                        </form>
                        <input class="form-control pull-right" name="searchTextVisible" id="searchTextVisible" placeholder="поиск по названию" type="text" value="{{ Request::get('searchText') }}">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="submit" onclick = "document.getElementById('searchText').value=document.getElementById('searchTextVisible').value; document.getElementById('searchForm').submit();">
                                    <i class="fa fa-search pull-right"></i>
                            </button>
                        </div>
                    </div>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped table-hover table-condensed">

                    <tr>
                        <th class="text-center"><a href="?page={{ $data['personal']->currentPage() }}&order=id&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Код</a>{!! $data['page_appends']['order'] == 'id' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th><a href="?page={{ $data['personal']->currentPage() }}&order=person_name&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Название</a>{!! $data['page_appends']['order'] == 'person_name' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th class="text-center"><a href="?page={{ $data['personal']->currentPage() }}&order=experience&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Опыт, лет</a>{!! $data['page_appends']['order'] == 'experience' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th class="text-center"><a href="?page={{ $data['personal']->currentPage() }}&order=hour_rate&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Ставка, р/час</a>{!! $data['page_appends']['order'] == 'hour_rate' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th class="text-center"><a href="?page={{ $data['personal']->currentPage() }}&order=speciality_id&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Специальность</a>{!! $data['page_appends']['order'] == 'speciality_id' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th class="text-center">Конт. инф.</th>
                        <th class="text-center"><a href="?page={{ $data['personal']->currentPage() }}&order=active&dir={{ $data['dir'] ? $data['dir'] : 'asc' }}{{ $data['searchText'] ? '&searchText='.$data['searchText'] : '' }}">Активен</a>{!! $data['page_appends']['order'] == 'active' ? $data['dir'] == 'desc' ? '<span class="glyphicon glyphicon-arrow-down"></span>' : '<span class="glyphicon glyphicon-arrow-up"></span>' : '' !!}</th>
                        <th class="text-right"></th>
                    </tr>

                    @foreach($data['personal'] as $person)
                        <tr> 
                            <td class="text-center">{{ $person->id }}</td>
                            <td><a href="/personal/{{ $person->id }}/edit">{{ $person->person_name }}</a>
                                <br>
                                <small>{{ str_limit($person->description,60) }}</small>
                                <br>
                                <small>
                                    @forelse ($person->personTechnologies as $technology)
                                        <span class="label label-success">{{ $technology->name }}&nbsp;</span>
                                        @if ($loop->index == 2)
                                                <span class="badge">всего: {{ $loop->count }}</span>
                                            @break;
                                        @endif
                                    @empty
                                        
                                    @endforelse
                                </small>
                            </td>
                            <td class="text-center">{{ $person->experience }}</td>
                            <td class="text-center">
                                {{ isset($person->hour_rate) ? $person->hour_rate : '' }}
                            </td>
                            <td class="text-center">{{ isset($person->speciality_id) ? $person->speciality->name : '' }}</td>
                            <td class="text-center">
                                @if (!Auth::guest() && Auth::user()->confirmed == 1 && Auth::user()->valid == 1)
                                    <div id="personInfo{{ $person->id }}">
                                        <form class="showPersonInfo" > 
                                            <input class="btn btn-xs" type="submit" value="Показать">
                                            <input type="hidden" name="_token"  id="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="person_id" id="object_id" value="{{ $person->id }}"/>
                                        </form>
                                    </div>
                                @else
                                    <div><span class="badge badge-warning">Нет прав</span></div>
                                @endif
                            </td>
                            <td class="text-center">
                                {!! $person->active ? '' : '<div><span class="badge badge-warning">нет</span></div>' !!}
                            </td>
                            <td class="text-right">
                                @if (Auth::user()->id == $person->user_id || Auth::user()->isAdmin())
                                    <form method="POST" action="{{action('PersonalController@destroyPerson',['id'=>$person->id])}}">
                                        <input type="hidden" name="_method" value="delete"/>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                        <input type="submit" class="btn btn-xs btn-default" value="Удалить"/>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach



                </table>
            </div> <!-- box body -->
            <div class="box-footer clearfix">
                <div class="box-tools pull-right">
                    {!! $data['personal']->appends($data['page_appends'])->links('vendor.pagination.default') !!}
                </div>
            </div><!-- /.box footer -->
        </div> <!-- /.box -->
    </div> <!-- /.col -->
</div> <!-- /.row -->
@stop

@section('jscripts')
    <script>
        $(document).ready(function(){
            $('.showPersonInfo').submit(function(e){
                e.preventDefault();

                var person_id = $(this).find("input[name=person_id]").val();
    
                $.ajax({
                    type: 'POST',
                    url: '/personal/info/' + person_id,
                    cache: false,
                    dataType: 'json',
                    data: {person_id: person_id,
                           '_token': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if (response.text == 'success') {
                            $("#personInfo"+person_id).html(response.person_info);
                        } else {
                            console.log(response.text + ' Не хватает прав для получения информации о сотруднике.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('oshibka');
                    }
                });
                return false;
            });               
        });
    </script>
@endsection