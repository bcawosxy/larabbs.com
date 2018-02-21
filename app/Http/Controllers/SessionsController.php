<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
	public function create()
	{
		return view('sessions.create');
	}

	public function store(Request $request)
	{
		$credentials = $this->validate($request, [
			'email' => 'required|email|max:255',
			'password' => 'required'
		]);

		if (Auth::attempt(['email' => $request->email, 'password' =>  $request->password], $request->has('remember'))) {
			session()->flash('success', 'Welcome Back！');
			return redirect()->route('user::show', [Auth::user()]);
		} else {
			session()->flash('danger', 'Sorry..， 帳號或密碼錯誤');
			return redirect()->back();
		}
		return;
	}

	public function destroy()
	{
		Auth::logout();
		session()->flash('success', '您已成功登出！');
		return redirect('login');
	}
}
