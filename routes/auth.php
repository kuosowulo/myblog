<?php

Route::get('login', 'AuthController@showlogin')->name('login');

Route::post('login', 'AuthController@login');