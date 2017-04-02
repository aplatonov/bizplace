<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Exception;
use Response;
use App\Users;
use App\Projects;
use App\Technology;
use App\Speciality;
use App\ProjectsHasTechnology;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('personCreate');
    }

    public function addProject(Request $request)
    {
        $form = $request->all();
        $form['owner_id'] = Auth::user()->id;

        if (isset($form['fromPage'])) {
            session(['fromPage' => $form['fromPage']]);
        }

        $specialities = Speciality::where('active', true)
            ->get();
        $technologies = Technology::where('active', true)
            ->get();

        //dd($users);
        return view('new-project')->with([
                'specialities' => $specialities,
                'technologies' => $technologies,
                'form' => $form
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProject(Request $request)
    {
        $form = $request->all();
        if ($form['isUpdate'] == 1) {
            $project = Projects::find($form['project_id']);
            $path = $project->doc;
        } else {
            $path = null;
        }

        $this->validate($request, [
            'project_name' => 'required|min:2|max:150',
            'description' => 'required',
            'speciality_id' => 'required|integer|min:1',
            'budget' => 'numeric|nullable',
            'doc' => 'file|max:1000|mimes:pdf,doc,docx,rtf',
            'start_date' => 'date|nullable',
            'finish_date' => 'date|nullable',
            'technologies' => 'present'
            ], [
            'project_name.required' => 'Название проекта обязательно к заполненнию',
            'speciality_id.min' => 'Необходимо выбрать специализацию',
            'technologies.present' => 'Укажите требуемые технологии проекта'
        ]); 
        
        //dd($form);

        $form['active'] = isset($form['active']) ? 1 : 0;
        if ($request->file('doc')) {
            try {
                if ($form['isUpdate'] == 1) {
                    Storage::delete($path);
                }
                $path = $request->file('doc')->store('projects_doc');
            } catch (Exception $e) {
                //возврат с сообщ об ошибке
            }
        }
        $form['doc'] = $path;

        if ($form['isUpdate'] == 1) {
            $project->update($form);
        } else {
            $project = Projects::create($form);
        }
                
        if ($project) {
            $project_id = $project->id;

            //сохраняем технологии в projects_has_technology
            if ($form['isUpdate'] == 1) {
                ProjectsHasTechnology::where('project_id', $project_id)->delete();
            }
            if (isset($form['technologies'])) {
                foreach ($form['technologies'] as $technology) {
                    ProjectsHasTechnology::create([
                        'project_id' => $project_id,
                        'technology_id' => $technology
                    ]);
                }
            }

        } 

        if ($form['isUpdate'] == 1) {
            return redirect('/'.session('fromPage'))->with(['message' => 'Данные проекта '.$project->project_name.' обновлены']);
        } else {
            return redirect('/'.session('fromPage'))->with(['message' => 'Проект '.$project->project_name.' добавлен']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProjects(Request $request)
    {
        $order = $request->get('order'); 
        $dir = $request->get('dir'); 
        $page_appends = null;
        $searchText = $request->get('searchText');

        if (Auth::user()->isAdmin()) 
        {
            //админу показываем все лоты
            $projects = Projects::whereIn('active', [0, 1]);
            if (\Route::currentRouteName() == 'userProjects') {
                $projects = $projects->where('owner_id', Auth::user()->id);
                $data['title'] = Auth::user()->name;
            }
        }
        else
        {
            //пользователю показываем незаблокированных специалистов и его собственнные заблокированные
            $projects = Projects::where('active', 1);
            if (\Route::currentRouteName() == 'userProjects') {
                $projects = $projects->where('owner_id', Auth::user()->id);
                $data['title'] = Auth::user()->name;
            } else {
                $projects = $projects
                    ->orWhere(function ($query) {
                        $query->where('owner_id', Auth::user()->id)
                            ->where('active', 1);
                    });
            }      
        }

        if (!empty($searchText)) {
            $projects = $projects
                ->where('project_name', 'LIKE', '%' . $searchText . '%');
        }

        if ($order && $dir) {
            $projects = $projects->orderBy($order, $dir);
            $page_appends = [
                'order' => $order,
                'dir' => $dir,
            ];
        } 

        $projects = $projects->paginate(config('app.objects_on_page'))->appends(['searchText' => $searchText]);

        $data['projects'] = $projects;
        $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
        $data['page_appends'] = $page_appends;
        $data['searchText'] = $searchText;

        return view('projects', ['data' => $data]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $project = Projects::findOrFail($id);
        $project['technologies'] = $project->projectTechnologies->keyBy('id')->keys()->toArray();
        $technologies = Technology::where('active', true)->get();
        $specialities = Speciality::where('active', true)->get();
        if (Auth::user()->isAdmin() || Auth::user()->id == $project->owner_id) {
            return view('edit-project')->with([
                'project' => $project,
                'technologies' => $technologies,
                'specialities' => $specialities]
        );
        } else  {
            return redirect()->back()->with('message', 'Недостаточно прав для редактирования проекта');
        }
    }
    
    public function showContactInfo(Request $request)
    {
        if (Auth::user()->confirmed == 1 && Auth::user()->valid == 1) {
            $project = Projects::findOrFail($request->input('project_id'));
            $project_info = '<small>' . $project->user->name . '<br>' . $project->user->contact_person . '<br>' . $project->user->phone . '<small>';
            $data = array( 'text' => 'success', 'project_info' => $project_info);
        } else {
            $data = array( 'text' => 'fail' . $request->input('action') );
        }
        return Response::json($data);
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Set Active flag in DB
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmProject(Request $request)
    {
    	$project = Projects::findOrFail($request->input('project_id'));
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id == $project->owner_id)) {
            $project->active = $request->input('action');
            $project->save();
            $data = array( 'text' => 'success' );
        } else {
            $data = array( 'text' => 'fail' . $request->input('action') );
        }
        return Response::json($data);
    }
}
