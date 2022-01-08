<?php

namespace App\Http\Controllers;

use App\Models\Post;


class DiscoverPostsController extends Controller
{
    public function __invoke()
    {
        return view('discover.posts-index',[
            'posts'=>Post::Discover()->paginate(10),
        ]);
    }
}
