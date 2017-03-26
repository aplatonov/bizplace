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
use Exception;
use Response;
use App\Users;
use App\Personal;
use App\Technology;
use App\Speciality;

class PersonalController extends Controller
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

    public function addPerson(Request $request)
    {
        //$form = $request->all();
        //dd($form);

        $specialities = Speciality::where('active', true)->get();
        $technologies = Technology::where('active', true)->get();

        return view('personCreate')->with([
                'specialities' => $specialities,
                'technologies' => $technologies]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'person_name' => 'required|unique:objects|max:191',
            'description' => 'required',
            'speciality_id' => 'required',
            'experience' => 'numeric|required',
            'resume' => 'file|max:1000|mimes:pdf,doc,docx,rtf',
            'hour_rate' => 'numeric|nullable',
            'free_since' => 'date|nullable',
            'active' => 'boolean',
        ]); 
        
        $form = $request->all();
        if (isset($form['active'])) {
            $form['active'] = '1';         
        }
        else {
            $form['active'] = '0';
        }
        
        $personal = Personal::create($form);
        
        //return redirect('objects/'.$object->id);
        return redirect('personal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personal = Personal::findOrFail($id);

        return view('personalShow', ['personal' => $personal]);
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPersonal(Request $request)
    {
        $order = $request->get('order'); 
        $dir = $request->get('dir'); 
        $page_appends = null;

        if (Auth::user()->isAdmin()) 
        {
            //админу показываем все лоты
            $personal = Personal::whereIn('active', [0, 1]);
        }
        else
        {
            //пользователю показываем незаблокированные лоты и его собственнные заблокированные
            $personal = Personal::where('active', 0)
                ->orWhere(function ($query) {
                    $query->where('user_id', Auth::user()->id)
                        ->where('active', 1);
                });        
        }

        if ($order && $dir) {
            $personal = $personal->orderBy($order, $dir);
            $page_appends = [
                'order' => $order,
                'dir' => $dir,
            ];
        } 

        $personal = $personal->paginate(config('app.objects_on_page'));

        $data['personal'] = $personal;
        $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
        $data['page_appends'] = $page_appends;

        return view('personal', ['data' => $data, 'message'=>'']);
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserPersonal(Request $request)
    {
        $order = $request->get('order');
        $dir = $request->get('dir');
        $page_appends = null;

        //хозяину показываем все лоты
        $personal = Personal::whereIn('active', [0, 1])->where('user_id', Auth::user()->id);

        if ($order && $dir) {
            $personal = $personal->orderBy($order, $dir);
            $page_appends = [
                'order' => $order,
                'dir' => $dir,
            ];
        }

        $personal = $personal->paginate(config('app.objects_on_page'));

        $data['personal'] = $personal;
        $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
        $data['page_appends'] = $page_appends;

        if (Auth::check()) {
            $username = Auth::user()->name . ' (' . Auth::user()->login . ')';
        } else {
            $username = '';
        }

        return view('layouts.personal', ['data' => $data, 'title'=>' пользователя '.$username]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $person = Personal::find($id);
        if (Auth::user()->isAdmin() || Auth::user()->id == $person->user_id) {
            return view('personEdit', ['person'=>$person]);
        } else  {
            return redirect()->back()->with('message', 'Недостаточно прав для редактирования сотрудника');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person = Personal::find($id);
        $this->validate($request, [
            'person_name' => 'required|unique:objects|max:191',
            'description' => 'required',
            'speciality_id' => 'required',
            'experience' => 'numeric|required',
            'resume' => 'file|max:1000|mimes:pdf,doc,docx,rtf',
            'hour_rate' => 'numeric|nullable',
            'free_since' => 'date|nullable',
            'active' => 'boolean',
        ]); 

        $form = $request->all();
        if (isset($form['disabled'])) {
            $form['disabled'] = '1';        
        }
        else {
            $form['disabled'] = '0';
        }

        $person->update($form);
        
        return redirect('personal/'.$person->id);
    }

    /**
     * Destroy a object instance after by valid user role.
     *
     * @param  integer  $id
     * @return string
     */
    public function destroyPerson($id)
    {
        $person = Personal::findOrFail($id);
        if (Auth::user()->isAdmin() || Auth::user()->id == $person->user_id) {     
            $personName = $person->person_name;
            try {
            	DB::table('personal_has_technology')->where('person_id', $id)->delete();
                $person->delete();
                return redirect()->back()->with('message', 'Сотрудник '.$personName.' удален');
            } catch (Exception $e) {
                return redirect()->back()->with('message', 'Невозможно удалить сотрудника '.$personName);
            }
        } else {
            return redirect()->back()->with('message', 'Недостаточно прав для удаления сотрудника');
        }
    }

    
    public function blockPerson(Request $request)
    {
        $person = Personal::findOrFail($request->input('person_id'));
        if (Auth::user()->isAdmin() || Auth::user()->id == $person->user_id) {
            $person->disabled = $request->input('action');
            $person->save();
            $data = array( 'text' => 'success' );
        } else {
            $data = array( 'text' => 'fail' . $request->input('action') );
        }
        return Response::json($data);
    }  

    
    public function showContactInfo(Request $request)
    {
        if (Auth::user()->confirmed == 1 && Auth::user()->valid == 1) {
            $person = Personal::findOrFail($request->input('person_id'));
            $person_info = '<small>' . $person->user->name . '<br>' . $person->user->contact_person . '<br>' . $person->user->phone . '<small>';
            $data = array( 'text' => 'success', 'person_info' => $person_info);
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
}
