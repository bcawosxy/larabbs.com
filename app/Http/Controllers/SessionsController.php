<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest', [
			'only' => ['create']
		]);
	}

	public function create()
	{
		return view('sessions.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|max:255',
			'password' => 'required'
		]);

		if (Auth::attempt(['email' => $request->email, 'password' =>  $request->password], $request->has('remember'))) {

			if(Auth::user()->activated) {
				session()->flash('success', 'Welcome Back！');
				return redirect()->intended(route('user::show', [Auth::user()]));
			} else {
				Auth::logout();
				session()->flash('warning', '您的帳號未驗證通過, 請確認驗證信。');
				return redirect('/');
			}

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
