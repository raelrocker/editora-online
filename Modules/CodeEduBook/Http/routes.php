<?php

Route::group(['middleware' => 'web', 'prefix' => 'codeedubook', 'namespace' => '\CodeEduBook\Http\Controllers'], function()
{
    Route::get('/', 'CodeEduBookController@index');
});
