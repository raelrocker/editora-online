<?php

Route::group(['as' => 'codeeduuser.'], function() {
    Route::group(['prefix' => 'admin'], function() {
        Route::resource('users', 'UsersController');
     });

     Route::get('email-verification/error', 'UserConfirmationController@getVerificationError')->name('email-verification.error');
     Route::get('email-verification/check/{token}', 'UserConfirmationController@getVerification')->name('email-verification.check');

});

