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

    Route::get('/user/{id}', function($id){

        $user = App\User::find($id);

        $latArr = [];
        $lngArr = [];

        foreach($user->recommendations as $rec) {
            if ($rec->cafe->latitude != 0) {
                $latArr[] = $rec->cafe->latitude;
                $lngArr[] = $rec->cafe->longitude;
            }
        }

        if (count($latArr) > 0) {
            $center = ['lat' => calculate_median($latArr), 'lng' => calculate_median($lngArr), 'zoom' => 13];
        } else {
            $center = ['lat' => 24.042571, 'lng' => 120.9472711, 'zoom' => 8];
        }

        if (Request::get('tab')) {
            $mode = Request::get('tab');
        } else {
            $mode = 'summary';
        }

        return view('history', ['user' => $user, 'center' => $center, 'mode' => $mode]);

    });

    Route::get('/user/{id}/map', function($id){

        $user = App\User::find($id);

        $latArr = [];
        $lngArr = [];

        foreach($user->recommendations as $rec) {
            if ($rec->cafe->latitude != 0) {
                $latArr[] = $rec->cafe->latitude;
                $lngArr[] = $rec->cafe->longitude;
            }
        }

        if (count($latArr) > 0) {
            $center = ['lat' => calculate_median($latArr), 'lng' => calculate_median($lngArr), 'zoom' => 13];
        } else {
            $center = ['lat' => 24.042571, 'lng' => 120.9472711, 'zoom' => 8];
        }

        return view('user/map', ['user' => $user, 'center' => $center]);

    });

    Route::get('/editing/{id}', function($id){

        if ( !Auth::check() ) {
            return redirect("login?&path=/editing/$id");
        }

        $entity = App\Entity::find($id);

        return view('editing', ['entity' => $entity]);

    });

    Route::post('/submit-editing', function(){
        $entity = App\Entity::find(Request::get('entity_id'));

        $infoFields = Request::only(getInfoKeys());

        $e = new App\Editing();

        $e->name = Request::get('name');

        $e->info_fields = json_encode($infoFields);

        $e->entity_id = Request::get('entity_id');

        $e->user_id = Auth::check() ? Auth::user()->id : 0;

        $e->address = Request::get('address');

        $e->save();

        $e->approve();

        return view('notice', ['title' => '修改成功！', 'message' => '非常謝謝您，已經更新進資料庫！']);
    });

    Route::get('/privacy-policy', function(){
        return view('privacy-policy');
    });

    Route::get('upload-photo', function(){
        return view('upload-photo');
    });

    Route::post('upload-photo', function(){
        $service = new App\UploadPhoto();

        $photo = $service->handle();

        $photo->cafe_id = Request::get('cafe_id');

        $photo->user_id = Auth::user()->id;

        $photo->save();

        return redirect(URL::previous());

    });

    Route::post('/remove-photo', function(){
        $p = \App\Photo::where('id', Request::get('photo_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        $p->status = \App\Photo::HIDDEN_STATUS;

        $p->save();

        return redirect()->back();
    });

    Route::post('/remove-post', function(){
        $p = \App\Post::where('id', Request::get('post_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($p->discussion->posts->first()->id == $p->id) {
            $discussion = $p->discussion;
            foreach ($discussion->posts as $post) {
                $post->delete();
            }
            $discussion->delete();
            return redirect('/forum');
        } else {
            $p->delete();
            return redirect()->back();
        }

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

    Route::get('/shop/search', 'ShopController@search');
    Route::post('/shop/new-tag', 'ShopController@newTag');
    Route::post('/shop/apply-tag', 'ShopController@applyTag');
    Route::post('/shop/unapply-tag', 'ShopController@unapplyTag');
    Route::post('/shop/report-tag', 'ShopController@reportTag');
    Route::post('/shop/unreport-tag', 'ShopController@unreportTag');

    Route::get('/shop/{id}/report', 'ShopController@report');
    Route::get('/shop/{id}/donate', 'ShopController@donate');

    Route::get('/shop/{id}/tag', 'ShopController@tag');

    Route::get('/shop/{id}/stats', 'ShopController@stats');

    Route::get('/shop/{id}/json', 'ShopController@json');

    foreach (Config::get('city') as $key => $value) {
        Route::get('/{' . $key . '}', 'CityController@getHomepage');

        Route::get('/{' . $key . '}/list', 'CityController@getList');

        Route::get('/{' . $key . '}/map', 'CityController@getMap');
    }
});
