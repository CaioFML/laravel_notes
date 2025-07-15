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
}
