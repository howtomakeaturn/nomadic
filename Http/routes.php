<?php

Route::group(['middleware' => 'web', /*'prefix' => 'nomadicore', */'namespace' => 'Modules\NomadiCore\Http\Controllers'], function()
{
    // Route::get('/', 'NomadiCoreController@index');

    Route::get('/', 'HomepageController@index');

    Route::get('/home', 'HomepageController@home');

    Route::get('/' . Config::get('nomadic.global.unit-url') . '/{id}', 'CityController@getshop');

    foreach (Config::get('city') as $key => $value) {
        Route::get('/{' . $key . '}', 'CityController@getHomepage');

        Route::get('/{' . $key . '}/list', 'CityController@getList');

        Route::get('/{' . $key . '}/map', 'CityController@getMap');
    }
});
