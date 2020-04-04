<?php

Route::get('index', 'HomeController@index');

Route::get('viewPost', 'HomeController@viewPost')->name('viewPost');

Route::get('post', 'HomeController@getPostForm')->name('post');

Route::post('post', 'HomeController@newPost');

Route::post('edit/{id}', 'HomeController@editPost');

Route::get('viewAbout', 'HomeController@viewAbout');

Route::get('login', 'HomeController@showlogin');

Route::post('login', 'HomeController@login');

Route::get('viewEditPost', 'HomeController@viewEditPost')->name('viewEditPost');

Route::post('uploadImage', 'HomeController@uploadImage')->name('uploadImage');

Route::get('deletePost', 'HomeController@deletePost')->name('deletePost');

Route::post('uploadFile', 'HomeController@uploadFile');

Route::get('showImage/{id}', 'HomeController@showImage');