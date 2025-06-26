<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function login(Request $request)
	{
		return view('login');
	}

	public function loginSubmit(Request $request)
	{
		echo 'loginSubmit';
	}

	public function logout(Request $request)
	{
		echo 'logout';
	}
}
