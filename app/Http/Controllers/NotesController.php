<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes;
use App\NotesCategory;
use App\Personal;
use App\Projects;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
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

    public function showNotes(Request $request)
    {
        $order = $request->get('order'); 
        $dir = $request->get('dir'); 
        $page_appends = null;
        $searchText = $request->get('searchText');

        $notes = Notes::whereIn('active', [0, 1]);
            
        if ($searchText>0) {
            $notes = $notes
                ->where('note_category_id', $searchText);
        }

        if ($order && $dir) {
            $notes = $notes->orderBy($order, $dir);
            $page_appends = [
                'order' => $order,
                'dir' => $dir,
            ];
        }

        $notes = $notes->paginate(50)->appends(['searchText' => $searchText]);
        $notesCategory = NotesCategory::all();

        $data['notes'] = $notes;
        $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
        $data['page_appends'] = $page_appends;
        $data['searchText'] = $searchText;
        $data['notesCategory'] = $notesCategory;

        return view('vendor.admin.notes', ['data' => $data]);
    }

    public function destroyNote($id)
    {
        $note = Notes::findOrFail($id);
        if (Auth::user()->isAdmin()) {     
            $noteName = $note->note_name;
            try {
                $note->delete();
                return redirect('/admin/notes')->with('message', 'Заметка '.$noteName.' удалена');
            } catch (Exception $e) {
                return redirect('/admin/notes')->with('message', 'Невозможно удалить заметку '.$noteName);
            }
        } else {
            return redirect('/admin/notes')->with('message', 'Недостаточно прав для удаления заметки');
        }
    }
}
