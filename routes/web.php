<?php

Route::get('/', 'StoreController@index');

Route::post('/create', 'StoreController@store');
