<?php

Route::get('post', 'HomeController@getPostForm')->name('post');

Route::post('post', 'HomeController@newPost');

Route::post('edit/{id}', 'HomeController@editPost');

Route::get('viewEditPost', 'HomeController@viewEditPost')->name('viewEditPost');

Route::post('uploadImage', 'HomeController@uploadImage')->name('uploadImage');

Route::get('deletePost', 'HomeController@deletePost')->name('deletePost');

Route::post('uploadFile', 'HomeController@uploadFile');

Route::get('showImage/{id}', 'HomeController@showImage');