<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Settings;

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
        $settings = Settings::select('how_it_works_1', 'how_it_works_2', 'how_it_works_3')->first();
        return view('home', ['settings'=>$settings]);
    }

    public function getContacts()
    {
        $settings = Settings::select('how_contact_us', 'address', 'phone', 'email', 'regime')->first();
        return view('contacts', ['settings'=>$settings]);
    }

    public function getAbout()
    {
        $settings = Settings::select('about_us_1', 'about_us_2', 'about_us_3')->first();
        return view('about', ['settings'=>$settings]);
    }

    public function getConfidential()
    {
        $settings = Settings::select('konfedential')->first();
        return view('confidential', ['settings'=>$settings]);
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
 