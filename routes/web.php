<?php

Route::get('/', 'Transfers@show');
Route::post('/transfer', 'Transfers@add');

Route::get('/users', 'Users@show');
Route::post('/user', 'Users@add');

