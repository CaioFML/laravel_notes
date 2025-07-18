<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    try {
      $id = Crypt::decrypt($id);

      $note = Note::find($id);

      if (!$note) {
        return redirect()->route('home')->with('error', 'Note not found.');
      }

      return view('editNote', ['note' => $note]);
    } catch (\Exception $e) {
      return redirect()->route('home')->with('error', 'Invalid note ID.');
    }

  }

  public function deleteNote($id) {
    $id = Crypt::decrypt($id);
    $note = Note::find($id);

    if (!$note) {
      return redirect()->route('home')->with('error', 'Note not found.');
    }

    $note->delete();

    return redirect()->route('home')->with('message', 'Note deleted successfully.');
  }
}
