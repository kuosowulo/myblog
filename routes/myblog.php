<?php

Route::get('/index', 'HomeController@index');

Route::get('/viewPost', 'HomeController@viewPost');

Route::get('/viewContact', 'HomeController@viewContact');

Route::get('/viewAbout', 'HomeController@viewAbout');

Route::get('/login', 'HomeController@showlogin');

Route::post('/login', 'HomeController@login');