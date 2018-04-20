<?php

Route::group(['middleware' => 'web', /*'prefix' => 'nomadicore', */'namespace' => 'Modules\NomadiCore\Http\Controllers'], function()
{
    // Route::get('/', 'NomadiCoreController@index');

    Route::get('/login', function(){
        Session::put('cafe_id', Request::get('cafe_id'));

        Session::put('path', Request::get('path'));

        Session::put('action', Request::get('action'));

        return Socialite::driver('facebook')->redirect();
    });

    Route::get('/callback', function(){

        if (Request::get('error_reason') == 'user_denied') {
            return redirect(Session::get('path'));
        }

        $facebook = Socialite::driver('facebook')->user();

        if ($credential = App\SocialCredential::where('social_id', $facebook->id)->first()) {

            Auth::loginUsingId($credential->user_id);

        } else {

            $user = new App\User();

            $email = $facebook->getEmail() ? $facebook->getEmail() : $facebook->getId() . '@facebook.com';

            $user->email = $email;

            $user->name = $facebook->getName();

            $user->password = '';

            $user->save();

            $profile = new App\Profile();

            $profile->user_id = $user->id;

            $profile->avatar = str_replace('type=normal', 'type=square', $facebook->getAvatar());

            $profile->save();

            $credential = new App\SocialCredential();

            $credential->user_id = $user->id;

            $credential->social_id = $facebook->id;

            $credential->save();

            Auth::login($user);

        }

        if (Session::get('action')=='recommend') {
            $rec = App\Recommendation::where('cafe_id', Session::get('cafe_id'))
                ->where('user_id', Auth::user()->id)
                ->first();

            if (!$rec) {
                $rec = new App\Recommendation();
                $rec->cafe_id = Session::get('cafe_id');
                $rec->user_id = Auth::user()->id;
                $rec->save();
            }
        }

        return redirect(Session::get('path'). '#' . Session::get('cafe_id'));
    });

    Route::get('/logout', function(){

        Auth::logout();

        return redirect('/');
    });

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

    Route::post('/ajax/wish', 'SocialController@ajaxWish');
    Route::post('/ajax/cancel-wish', 'SocialController@ajaxCancelWish');

    Route::post('/ajax/visit', 'SocialController@ajaxVisit');
    Route::post('/ajax/cancel-visit', 'SocialController@ajaxCancelVisit');

    Route::post('/ajax/comment', 'SocialController@ajaxComment');
    Route::post('/add-comment', 'SocialController@addComment');
    Route::post('/remove-comment', 'SocialController@removeComment');

    Route::post('/submit-review', 'SocialController@submitReview');
    Route::post('/update-review', 'SocialController@updateReview');
    Route::post('/delete-review', 'SocialController@deleteReview');

    Route::get('/reviewers/{id}', 'SocialController@reviewers');
    Route::get('/review/{id}', 'SocialController@review');

    foreach (Config::get('city') as $key => $value) {
        Route::get('/{' . $key . '}', 'CityController@getHomepage');

        Route::get('/{' . $key . '}/list', 'CityController@getList');

        Route::get('/{' . $key . '}/map', 'CityController@getMap');
    }
});
