<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	protected $table = 'users';

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Eloquent 事件, 監聽 creating發生時執行的事件 ( https://d.laravel-china.org/docs/5.4/eloquent#events )
	 *  此處則是監聽建立使用者後自動填入一驗證帳號用令牌字串
	 */
	public static function boot()
	{
		parent::boot();

		static::creating(function ($user) {
			$user->activation_token = str_random(30);
		});
	}

	public function gravatar($size = '140')
	{
		$hash = md5(strtolower(trim($this->attributes['email'])));
		return "http://www.gravatar.com/avatar/$hash?s=$size";
	}

	public function statuses()
	{
		return $this->hasMany(Status::class);
	}
}
