<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use NotesTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getContacts()
    {
        return view('contacts');
    }

    public function getAbout()
    {
        return view('about');
    }

    public function getConfidential()
    {
        return view('confidential');
    }

    public function sendFeedback(Request $request)
    {
        $form = $request->all();
        
        $this->validate($request, [
            'person_name' => 'required|min:2|max:150',
            'description' => 'required|min:10',
            'email' => 'required|email'
            ], [
            'person_name.required' => 'Имя обязательно к заполненнию',
            'description.required' => 'Пустое сообщение недопустимо',
            'description.min' => 'Напишите подробнее',
        ]); 
        //$this->feedbackNote($note_name, $description, $from_user_id, $link)
        $from_user_id = Auth::guest() ? null : Auth::user()->id;
        if ($this->feedbackNote('Feedback от '.$form['person_name'], 
                                $form['description'], 
                                $from_user_id, 
                                $form['email'])) 
        {
            return redirect('/contacts')->with(['message' => 'Сообщение успешно отправлено']);
        } else {
            return redirect('/contacts')->with(['message' => 'Не удалось отправить сообщение']);
        }

    }
}
 