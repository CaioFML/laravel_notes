<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index() {
    echo '<h1>Welcome to the Main Page</h1>';
  }

  public function newNote() {
    echo '<h1>Create a New Note</h1>';
  }
}
