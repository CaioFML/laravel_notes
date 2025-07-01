<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

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
			'text_username' => 'required|email',
			'text_password' => 'required|min:6|max:16',
		],
		[
			'text_username.required' => 'Username is required',
			'text_username.email' => 'Username must be a valid email address',
			'text_password.required' => 'Password is required',
			'text_password.min' => 'Password must be at least :min characters',
			'text_password.max' => 'Password must not exceed :max characters',
		]);

		$username = $request->input('text_username');
		$password = $request->input('text_password');

		// Check if the user exists
		$user = User::where('username', $username)->where('deleted_at', NULL)->first();

		if (!$user) {
			return redirect()->back()->withInput()->with(['loginError' => 'Username or password is incorrect']);
		}

		// Check if the password is correct
		if (!password_verify($password, $user->password)) {
			return redirect()->back()->withInput()->with(['loginError' => 'Username or password is incorrect']);
		}

		$user->last_login = now();
		$user->save();

		session(['user' => [
			'id' => $user->id,
			'username' => $user->username,
			'last_login' => $user->last_login,
		]]);

		echo '<pre>';
		print_r($user);
	}

	public function logout(Request $request)
	{
		echo 'logout';
	}
}
