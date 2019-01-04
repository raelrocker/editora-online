<?php

Route::get('/', 'StoreController@index');
Route::get('/pub/categories/{id}', 'StoreController@category')->name('store.category');
Route::get('/pub/search', 'StoreController@search')->name('store.search');