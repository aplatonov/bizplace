<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Skill;

class SkillsController extends Controller
{
    /* Create a new controller instance.
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
        $this->authorize('admin-control');
        $skills =  Skill::all();
        return view('skills.index',['skills' => $skills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin-control');
        return view('skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin-control');
        $this->validate($request,[
            'name'=> 'required|max:30',
        ]);

        $form = $request->all();
        $form['active'] = isset($form['active']) ? 1 : 0;

        $skill = Skill::create($form);

        if($skill) {
            return redirect()->route('skills.index')->with(['message' => 'Уровень создан']);
        } else {
            return redirect()->route('skills.index')->with(['message' => 'При сохранении уровня произошла ошибка']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin-control');
        $skill = Skill::findOrFail($id);
        return view('skills.edit',compact('skill'));
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
        $this->authorize('admin-control');
        $this->validate($request,[
            'name'=> 'required|max:30',
        ]);

        $form = $request->all();
        $form['active'] = isset($form['active']) ? 1 : 0;

        $skill = Skill::findOrFail($id);
        $skill->update($form);

        if($skill) {
            return redirect()->route('skills.index')->with(['message' => 'Уровень обновлен']);
        } else {
            return redirect()->route('skills.index')->with(['message' => 'При обновлении уровня произошла ошибка']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('admin-control');
        $skill = Skill::findOrFail($id);
        try {
            $skill->delete();
            return redirect()->route('skills.index')->with(['message' => 'Уровень удален']);
        } catch (Exception $e) {
            return redirect()->route('skills.index')->with(['message' => 'При удалении уровня произошла ошибка']);
        }
    }
}
