<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
	public function create()
	{
		return view('users.create');
	}

	public function show(User $user)
	{
		return view('users.show', compact('user'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:50',
			'email' => 'required|email|unique:users|max:255',
			'password' => 'required|confirmed|min:6'
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);

		session()->flash('success', '註冊完成~歡迎光臨'. $request->name);
		return redirect()->route('user::show', [$user]);
	}
}
