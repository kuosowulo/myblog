<?php

use App\Http\Controllers\HomeController;

Route::get('/index', 'HomeController@index');

Route::get('/viewPost', 'HomeController@viewPost');

Route::get('/viewContact', 'HomeController@viewContact');

Route::get('/viewAbout', 'HomeController@viewAbout');

