<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\View;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return view('posts.index', [
                'posts' => Post::Newsfeed()->paginate(6)->withQueryString(),
            ]);
        } else {
            return view('posts.index', [
                'posts' => Post::latest()->paginate(6)->withQueryString(),
            ]);
        }
    }

    public function show(Post $post)
    {
        $like = Like::likedBy($post->id);

        return view('posts.show', [
            'post' => $post,
            'liked' => $like[0],
            'likes_count' => $like[1],
            'views_count' => View::ViewedBy($post->id),
        ]);
    }

}
