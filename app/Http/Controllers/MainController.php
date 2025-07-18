<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;

class MainController extends Controller
{
  public function index() {
    $id = session('user.id');
    $user = User::find($id)->toArray();
    $notes = User::find($id)->notes()->get()->toArray();

    return view('home', ['notes' => $notes]);
  }

  public function newNote() {
    return view('new_note');
  }

  public function newNoteSubmit() {
    $data = request()->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);

    $note = new Note();
    $note->title = $data['title'];
    $note->content = $data['content'];
    $note->user_id = session('user.id');
    $note->save();

    return redirect()->route('home')->with('message', 'Note created successfully.');
  }

  public function editNote($id) {
    $note = Note::find(Operations::decryptId($id));

    if (!$note) {
      return redirect()->route('home')->with('error', 'Note not found.');
    }

    return view('editNote', ['note' => $note]);
  }

  public function deleteNote($id) {
    $note = Note::find(Operations::decryptId($id));

    if (!$note) {
      return redirect()->route('home')->with('error', 'Note not found.');
    }

    $note->delete();

    return redirect()->route('home')->with('message', 'Note deleted successfully.');
  }
}
