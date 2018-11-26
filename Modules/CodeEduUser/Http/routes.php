<?php

Route::group(['prefix' => 'admin', 'as' => 'codeeduuser.'], function() {
   Route::resource('users', 'UsersController');
});
