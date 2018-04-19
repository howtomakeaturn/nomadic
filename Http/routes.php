<?php

Route::group(['middleware' => 'web', 'prefix' => 'nomadicore', 'namespace' => 'Modules\NomadiCore\Http\Controllers'], function()
{
    Route::get('/', 'NomadiCoreController@index');
});
