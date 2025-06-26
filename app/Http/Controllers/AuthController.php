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
		// $_POST['username']

		// dd($request);

		echo $request->input('text_username');
		echo $request->input('text_password');
	}

	public function logout(Request $request)
	{
		echo 'logout';
	}
}
