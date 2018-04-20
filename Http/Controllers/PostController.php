<?php

namespace Modules\NomadiCore\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Modules\NomadiCore\Discussion;
use Modules\NomadiCore\Post;
use Modules\NomadiCore\PostComment as Comment;
use Auth;
use Request;
use Layout;
use Config;

class PostController extends BaseController
{

    function posts()
    {
        return redirect('/forum');
    }

    function index()
    {
        Layout::setOpenGraphTitle(Config::get('nomadic.global.app') . ' ' . Config::get('nomadic.forum.label'));

        Layout::setOpenGraphImage(url('/android-chrome-384x384.png'));

        $discussions = \CafeNomad::getDiscussions();

        return view('posts/index', compact('discussions'));
    }

    function post($id)
    {
        $discussion = Discussion::find($id);

        Layout::setOpenGraphTitle($discussion->title . ' - Cafe Nomad');

        Layout::setOpenGraphImage(url('/android-chrome-384x384.png'));

        return view('posts/post', compact('discussion'));
    }

    function edit($id)
    {
        $post = Post::whereId($id)->whereUserId(Auth::user()->id)->first();

        return view('posts/edit', compact('post'));
    }

    function create()
    {
        return view('posts/create');
    }

    function createPost()
    {
        $discussion = new Discussion();

        $discussion->title = Request::get('title');

        $discussion->save();

        $post = new Post();

        $post->discussion_id = $discussion->id;

        $post->content = Request::get('content');

        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('/post/' . $discussion->id);
    }

    function replyPost()
    {
        $post = new Post();

        $post->discussion_id = Request::get('discussion_id');

        $post->content = Request::get('content');

        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('/post/' . $post->discussion_id . '#post-' . $post->id);
    }

    function updatePost()
    {
        $post = Post::whereId(Request::get('post_id'))->whereUserId(Auth::user()->id)->first();

        $post->content = Request::get('content');

        $post->save();

        return redirect('/post/' . $post->discussion_id . '#post-' . $post->id);
    }

    function commentToPost()
    {
        $comment = new Comment();

        $comment->post_id = Request::get('post_id');

        $comment->content = Request::get('content');

        $comment->user_id = Auth::user()->id;

        $comment->save();

        $post = Post::find(Request::get('post_id'));

        return redirect('/post/' . $post->discussion_id . '#comment-' . $comment->id);
    }

}
