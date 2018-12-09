<?php

Route::group(['middleware' => ['auth', config('codeeduuser.middleware.isVerified'), 'auth.resource']], function() {
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('books', 'BooksController', ['except' => 'show']);
    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function() {
        Route::resource('books', 'BooksTrashedController', [
            'except' => ['store', 'create', 'edit', 'destroy']
        ]);
    });
});