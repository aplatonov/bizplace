<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        View::composer(['*'], function($view)
        {
            if (Auth::check()) {
                if (isset(Auth::user()->prev_login)) {
                    $prev_login = Auth::user()->prev_login;
                } else {
                    $prev_login = '1970-01-01';
                }
                if (Auth::user()->isAdmin()) {
                    $notes['notif'] = DB::table('notes')
                        ->where('notes.created_at','>',$prev_login)
                        ->whereIn('notes.note_category_id', [1,2,3,4])
                        ->join('notes_category', 'notes.note_category_id', '=', 'notes_category.id')
                        ->select(DB::raw('count(*) as notes_count, max(notes.created_at) as note_last, notes.note_category_id, notes_category.name'))
                        ->groupBy('notes.note_category_id', 'notes_category.name')
                        ->get();

                    $notes['forms'] = DB::table('notes')
                        ->where('notes.created_at','>',$prev_login)
                        ->whereIn('notes.note_category_id', [5,6,7])
                        ->join('notes_category', 'notes.note_category_id', '=', 'notes_category.id')
                        ->select(DB::raw('count(*) as notes_count, notes.note_category_id, notes_category.name'))
                        ->groupBy('notes.note_category_id', 'notes_category.name')
                        ->get();

                    $notes['newProjects'] = DB::table('projects')
                        ->where('created_at','>',$prev_login)
                        ->where('active', true)
                        ->where('owner_id','!=',Auth::user()->id)
                        ->count();
                    $notes['newUsers'] = DB::table('users')
                        ->where('created_at','>',$prev_login)
                        ->where('id','!=',Auth::user()->id)
                        ->count();
                    $notes['newPersonal'] = DB::table('personal')
                        ->where('created_at','>',$prev_login)
                        ->where('active', true)
                        ->where('user_id','!=',Auth::user()->id)
                        ->count();
                        //dd($notes['forms']);
                    $notes['sumNotif'] = $notes['notif']->sum('notes_count') + $notes['newProjects'] + $notes['newUsers'] + $notes['newPersonal'];
                } else {
                    $notes['notif'] = DB::table('notes')
                        ->where('notes.created_at','>',$prev_login)
                        ->where('notes.to_user_id','=',Auth::user()->id)
                        ->whereIn('notes.note_category_id', [1,2,3,4])
                        ->join('notes_category', 'notes.note_category_id', '=', 'notes_category.id')
                        ->select(DB::raw('count(*) as notes_count, notes.note_category_id, notes_category.name'))
                        ->groupBy('notes.note_category_id', 'notes_category.name')
                        ->get();

                    $notes['forms'] = DB::table('notes')
                        ->where('notes.created_at','>',$prev_login)
                        ->where('notes.to_user_id','=',Auth::user()->id)
                        ->whereIn('notes.note_category_id', [5])
                        ->join('notes_category', 'notes.note_category_id', '=', 'notes_category.id')
                        ->select(DB::raw('count(*) as notes_count, max(notes.created_at) as note_last, notes.note_category_id, notes_category.name'))
                        ->groupBy('notes.note_category_id', 'notes_category.name')
                        ->get();
                    $notes['sumNotif'] = $notes['notif']->sum('notes_count') ;
                }
                
                $view->with(['notes' => $notes]);
            } else {
                $view->with(['notes' => []]);
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
