<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;
use Mail;
use Auth;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth', [
			'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
		]);

		$this->middleware('guest', [
			'only' => ['create']
		]);
	}

	public function create()
	{
		return view('users.create');
	}

	public function confirmEmail($token)
	{
		$user = User::where('activation_token', $token)->firstOrFail();

		$user->activated = true;
		$user->activation_token = null;
		$user->save();

		Auth::login($user);
		session()->flash('success', '恭喜你，激活成功！');
		return redirect()->route('user::show', [$user]);
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

	protected function sendEmailConfirmationTo($user)
	{
		$view = 'emails.confirm';
		$data = compact('user');
		$from = 'aufree@yousails.com';
		$name = 'Aufree';
		$to = $user->email;
		$subject = "感謝註冊, 請驗證您的信箱。";

		Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
			$message->from($from, $name)->to($to)->subject($subject);
		});
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

		$this->sendEmailConfirmationTo($user);
		session()->flash('success', '註冊驗證信件已發送, 請確認信箱。');

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
