<?php

Route::get('index', 'HomeController@index');

Route::get('viewPost', 'HomeController@viewPost')->name('viewPost');

Route::get('post', 'HomeController@getPostForm')->name('post');

Route::post('post', 'HomeController@newPost');

Route::get('viewAbout', 'HomeController@viewAbout');

Route::get('login', 'HomeController@showlogin');

Route::post('login', 'HomeController@login');