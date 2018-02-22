<?php

Route::group(['prefix'=>'/', 'as'=>'static::'], function() {
	Route::get('/', ['as'=> 'index','uses'=> 'StaticPagesController@index']) ;

	Route::get('login', ['as' => 'login', 'uses'=> 'SessionsController@create']);
	Route::post('login', ['as' => 'login','uses' => 'SessionsController@store']);
	Route::delete('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
});

Route::group(['prefix'=>'/user', 'as'=>'user::'], function() {
	Route::get('/signup', ['as'=> 'signup','uses'=> 'UsersController@create']) ;
	Route::get('/{user}', ['as'=> 'show','uses'=> 'UsersController@show']) ;
	Route::get('/{user}/edit', ['as'=> 'edit','uses'=> 'UsersController@edit']) ;
	Route::get('/', ['as'=> 'index','uses'=> 'UsersController@index']) ;
	Route::patch('/{user}/update', ['as'=> 'update','uses'=> 'UsersController@update']) ;

	Route::post('/store', ['as'=> 'store','uses'=> 'UsersController@store']) ;
});