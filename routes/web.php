<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'StoreController@index');

Route::get('/download/{id}', 'StoreController@download');

Route::post('/create', 'StoreController@store');

Route::post('/remove', 'StoreController@destroy');
