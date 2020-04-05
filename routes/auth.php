<?php

Route::get('login', 'AuthController@showlogin')->name('login');

Route::post('login', 'AuthController@login');

Route::get('index', 'AuthController@index');

Route::get('viewPost', 'AuthController@viewPost')->name('viewPost');