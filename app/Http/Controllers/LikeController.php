<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);
        return back()->with('success', 'You have liked ' . $post->title . ' successfully');
    }

    public function destroy(Post $post)
    {
        Like::where('post_id', $post->id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'You have disliked ' . $post->title . ' successfully');
    }
}
