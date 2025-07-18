<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index()
  {
    $id = session('user.id');
    $user = User::find($id)->toArray();
    $notes = User::find($id)->notes()->get()->toArray();

    return view('home', ['notes' => $notes]);
  }

  public function newNote()
  {
    return view('new_note');
  }

  public function newNoteSubmit(Request $request)
  {
    $data = request()->validate(
      [
        'text_title' => 'required|min:3|max:200',
        'text_note' => 'required|min:3|max:3000',
      ],
      [
        'text_title.required' => 'The title is required.',
        'text_title.min' => 'The title must contain :max at max.',
        'text_title.max' => 'The title must contain :min at min.',
        'text_note.required' => 'The content is required.',
        'text_note.min' => 'The content must contain :max at max.',
        'text_note.max' => 'The content must contain :min at min.',
      ]
    );

    $note = new Note();
    $note->title = $request->text_title;
    $note->content = $request->text_note;
    $note->user_id = session('user.id');
    $note->save();

    return redirect()->route('home')->with('message', 'Note created successfully.');
  }

  public function editNote($id)
  {
    $note = Note::find(Operations::decryptId($id));

    if (!$note) {
      return redirect()->route('home')->with('error', 'Note not found.');
    }

    return view('editNote', ['note' => $note]);
  }

  public function deleteNote($id)
  {
    $note = Note::find(Operations::decryptId($id));

    if (!$note) {
      return redirect()->route('home')->with('error', 'Note not found.');
    }

    $note->delete();

    return redirect()->route('home')->with('message', 'Note deleted successfully.');
  }
}
