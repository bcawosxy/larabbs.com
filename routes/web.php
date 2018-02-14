<?php

Route::group(['prefix'=>'/', 'as'=>'static::'], function() {
	Route::get('/', ['as'=> 'index','uses'=> 'StaticPagesController@index']) ;
});

Route::group(['prefix'=>'/user', 'as'=>'user::'], function() {
	Route::get('/signup', ['as'=> 'signup','uses'=> 'UsersController@create']) ;
});