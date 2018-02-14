<?php

Route::group(['prefix'=>'/', 'as'=>'static::'], function() {
	Route::get('/', ['as'=> 'index','uses'=> 'StaticPagesController@index']) ;
});