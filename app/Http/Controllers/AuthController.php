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

		$request->validate([
			'text_username' => 'required',
			'text_password' => 'required',
		]);

		$username = $request->input('text_username');
		$password = $request->input('text_password');

		echo 'OK';
	}

	public function logout(Request $request)
	{
		echo 'logout';
	}
}
