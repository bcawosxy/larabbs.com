<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
		\App\Models\User::class  => \App\Policies\UserPolicy::class,
	];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Carbon::setLocale('zh-TW');
		Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
