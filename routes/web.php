<?php

Route::get('/', 'Transfers@show'); //переводы - домашняя страница
Route::post('/transfer', 'Transfers@add');

Route::get('/users', 'Users@show');
Route::post('/user', 'Users@add');

