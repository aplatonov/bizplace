<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:30|unique:users',
            'email' => 'required|email|max:120',
            'password' => 'required|min:6|confirmed',
            'name' => 'required|max:190',
            'contact_person' => 'max:80',
            'phone' => 'required|max:60',
            'portfolio' => 'file|max:500|mimes:pdf,doc,docx,rtf',
            'logo' => 'file|max:100|mimes:jpg,gif,png',
            'www' => 'url|max:150'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(32);
        
        $data['link'] = '/register/confirm/' . $confirmation_code;
        
        /*
        Mail::send('layouts.mailconfirm', $data, function ($message) use ($data) {
                $message->to($data['email'])
                    ->subject('Confirm registration ' . $data['login']);
            });
        */
        
        if(!empty($data['portfolio'])) {
            $file_portfolio = $data['portfolio'];
            $new_file_portfolio = str_random(8) . '.' . $file->getClientOriginalExtension();
        } else {
            $new_file_portfolio = null;
        }

        if(!empty($data['logo'])) {
            $file_logo = $data['logo'];
            $new_file_logo = str_random(8) . '.' . $file->getClientOriginalExtension();
        } else {
            $new_file_logo = null;
        }
        $data['portfolio'] = $new_file_portfolio;
        $data['logo'] = $new_file_logo;

        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'name' => $data['name'],
            'contact_person' => $data['contact_person'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmation_code,
            'portfolio' => $new_file_portfolio,
            'logo' => $new_file_logo,
            'www' => $data['www'],
        ]);

        if ($user && $new_file_portfolio) {
            //$_SERVER['DOCUMENT_ROOT'] . 
            $root = '/uploads/users/' . $user->id;
            if(!file_exists($root)) {
                if (!mkdir($root, 0777, true)) {
                        dump('Не могу создать папку для файлов');
                    }
            }
            $file_portfolio->move($root, $new_file_protfolio);
        }

        if ($user && $new_file_logo) {
            //$_SERVER['DOCUMENT_ROOT'] . 
            $root = '/uploads/users/' . $user->id;
            if(!file_exists($root)) {
                if (!mkdir($root, 0777, true)) {
                        dump('Не могу создать папку для файлов');
                    }
            }
            $file_logo->move($root, $new_file_logo);
        }

        return $user;
    }
}
