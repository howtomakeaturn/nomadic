<?php

Route::group(['middleware' => 'web', /*'prefix' => 'nomadicore', */'namespace' => 'Modules\NomadiCore\Http\Controllers'], function()
{
    // Route::get('/', 'NomadiCoreController@index');

    Route::get('/', 'HomepageController@index');

    Route::get('/home', 'HomepageController@home');

    Route::get('/' . Config::get('nomadic.global.unit-url') . '/{id}', 'CityController@getshop');

    Route::get('/posts', 'PostController@posts');
    Route::get('/forum', 'PostController@index');
    Route::get('/post/{id}', 'PostController@post');
    Route::get('/new-post', 'PostController@create');
    Route::post('/new-post', 'PostController@createPost');
    Route::post('/reply-post', 'PostController@replyPost');
    Route::get('/post/edit/{id}', 'PostController@edit');
    Route::post('/update-post', 'PostController@updatePost');
    Route::post('/comment-to-post', 'PostController@commentToPost');

    Route::get('/contribute', 'CommunityController@contribute');
    Route::post('/contribute', 'CommunityController@saveContribution');

    foreach (Config::get('city') as $key => $value) {
        Route::get('/{' . $key . '}', 'CityController@getHomepage');

        Route::get('/{' . $key . '}/list', 'CityController@getList');

        Route::get('/{' . $key . '}/map', 'CityController@getMap');
    }
});
