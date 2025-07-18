<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
    echo '<h1>Create a New Note</h1>';
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
