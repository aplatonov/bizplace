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
use App\Personal;
use App\Technology;
use App\Speciality;
use App\PersonalHasTechnology;

class PersonalController extends Controller
{
    use NotesTrait;

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
        $this->authorize('user-valid');
        session(['fromPage' => \URL::previous()]);
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;

        $specialities = Speciality::where('active', true)
            ->get();
        $technologies = Technology::where('active', true)
            ->get();

        //dd($users);
        return view('new-person')->with([
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
    public function storePerson(Request $request)
    {
        $this->authorize('user-valid');
        $form = $request->all();
        //dd($form);
        if ($form['isUpdate'] == 1) {
            $person = Personal::find($form['person_id']);
            $path = $person->resume;
        } else {
            $path = null;
        }

        $this->validate($request, [
            'person_name' => 'required|min:2|max:191',
            'description' => 'required',
            'speciality_id' => 'required|integer|min:1',
            'experience' => 'required|numeric',
            'resume' => 'file|max:1000|mimes:pdf,doc,docx,rtf',
            'hour_rate' => 'numeric|nullable',
            'free_since' => 'date|nullable',
            'technologies' => 'present'
            ], [
            'person_name.required' => 'Название сотрудника обязательно к заполненнию',
            'speciality_id.min' => 'Необходимо выбрать специализацию',
            'technologies.present' => 'Сотрудник должен владеть хотя бы одной технологией'
        ]); 
        
        //dd($form);

        $form['active'] = isset($form['active']) ? 1 : 0;
        if ($request->file('resume')) {
            try {
                if ($form['isUpdate'] == 1) {
                    Storage::delete($path);
                }
                $path = $request->file('resume')->store('resume');
            } catch (Exception $e) {
                //возврат с сообщ об ошибке
            }
        }
        $form['resume'] = $path;

        if ($form['isUpdate'] == 1) {
            $person->update($form);
        } else {
            $person = Personal::create($form);
        }
                
        if ($person) {
            $person_id = $person->id;

            //сохраняем технологии в personal_has_technology
            if ($form['isUpdate'] == 1) {
                PersonalHasTechnology::where('person_id', $person_id)->delete();
            }
            if (isset($form['technologies'])) {
                foreach ($form['technologies'] as $technology) {
                    PersonalHasTechnology::create([
                        'person_id' => $person_id,
                        'technology_id' => $technology
                    ]);
                }
            }

        } //$demand == true

        if ($form['isUpdate'] == 1) {
            return redirect(session('fromPage'))->with(['message' => 'Данные сотрудника '.$person->person_name.' обновлены']);
        } else {
            return redirect(session('fromPage'))->with(['message' => 'Сотрудник '.$person->person_name.' добавлен']);
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
    public function showPersonal(Request $request)
    {
        $this->authorize('user-unconfirmed');
        $order = $request->get('order'); 
        $dir = $request->get('dir'); 
        $page_appends = null;
        $searchText = $request->get('searchText');

        if (Auth::user()->isAdmin()) 
        {
            //админу показываем все лоты
            $personal = Personal::whereIn('active', [0, 1]);
            if (\Route::currentRouteName() == 'userPersonal') {
                $personal = $personal->where('user_id', Auth::user()->id);
                $data['title'] = Auth::user()->name;
            }
        }

        if (Auth::user()->isValidUser() || Auth::user()->isUnconfirmedUser()) {
            if (\Route::currentRouteName() == 'userPersonal') {
                $personal = Personal::whereIn('active', [0, 1])->where('user_id', Auth::user()->id);
                $data['title'] = Auth::user()->name;
            } else {
                $personal = Personal::where('active', 1);
            }  
        }

        if (!empty($searchText)) {
            $personal = $personal
                ->where('person_name', 'LIKE', '%' . $searchText . '%');
        }

        if ($order && $dir) {
            $personal = $personal->orderBy($order, $dir);
            $page_appends = [
                'order' => $order,
                'dir' => $dir,
            ];
        } 

        $personal = $personal->paginate(config('app.objects_on_page'))->appends(['searchText' => $searchText]);

        $data['personal'] = $personal;
        $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
        $data['page_appends'] = $page_appends;
        $data['searchText'] = $searchText;

        return view('personal', ['data' => $data]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('user-valid');
        $person = Personal::findOrFail($id);
        session(['fromPage' => \URL::previous()]);

        //dd(\URL::previous(), \Request::fullUrl());

        $person['technologies'] = $person->personTechnologies->keyBy('id')->keys()->toArray();
        $technologies = Technology::where('active', true)->get();
        $specialities = Speciality::where('active', true)->get();
        if (Auth::user()->isAdmin() || Auth::user()->id == $person->user_id) {
            return view('edit-person')->with([
                'person' => $person,
                'technologies' => $technologies,
                'specialities' => $specialities]
        );
        } else  {
            return redirect(session('fromPage'))->with('message', 'Недостаточно прав для редактирования сотрудника');
        }
    }

    /**
     * Destroy a object instance after by valid user role.
     *
     * @param  integer  $id
     * @return string
     */
    public function destroyPerson($id)
    {
        $this->authorize('user-valid');
        $person = Personal::findOrFail($id);
        session(['fromPage' => \URL::previous()]);
        if (Auth::user()->isAdmin() || Auth::user()->id == $person->user_id) {     
            $personName = $person->person_name;
            try {
            	DB::table('personal_has_technology')->where('person_id', $id)->delete();
                $person->delete();
                return redirect(session('fromPage'))->with('message', 'Сотрудник '.$personName.' удален');
            } catch (Exception $e) {
                return redirect(session('fromPage'))->with('message', 'Невозможно удалить сотрудника '.$personName);
            }
        } else {
            return redirect(session('fromPage'))->with('message', 'Недостаточно прав для удаления сотрудника');
        }
    }
    
    public function showContactInfo(Request $request)
    {
        if (Auth::user()->confirmed == 1 && Auth::user()->valid == 1) {
            $person = Personal::findOrFail($request->input('person_id'));
            $person_info = '<small>' . $person->user->name . '<br>' . $person->user->contact_person . '<br>' . $person->user->phone . '<br><a href="mailto:' . $person->user->email . '">'.$person->user->email.'</a><small>';
            $data = array( 'text' => 'success', 'person_info' => $person_info);
            $this->personalNote($person->user->id, Auth::user()->id, $person->id);
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
