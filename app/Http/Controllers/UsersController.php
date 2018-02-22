<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', [
			'except' => ['show', 'create', 'store', 'index']
		]);

		$this->middleware('guest', [
			'only' => ['create']
		]);
	}

	public function create()
	{
		return view('users.create');
	}

	public function edit(User $user)
	{

		return view('users.edit', compact('user'));
	}

	public function index()
	{
		$users = User::paginate(10);
		return view('users.index', compact('users'));
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

		Auth::login($user);
		session()->flash('success', '註冊完成~歡迎光臨'. $request->name);
		return redirect()->route('user::show', [$user]);
	}

	public function update(User $user, Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:50',
			'password' => 'nullable|confirmed|min:6'
		]);

		$data = [];
		$data['name'] = $request->name;
		if ($request->password) {
			$data['password'] = bcrypt($request->password);
		}
		$user->update($data);

		session()->flash('success', '資料更新成功！');

		return redirect()->route('user::show', $user->id);
	}
}
