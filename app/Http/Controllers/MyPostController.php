<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TrainingPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class MyPostController extends Controller
{
    public function index(User $user)
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', $user->id)->latest()->paginate(6)->withQueryString(),
        ]);
    }

    public function store()
    {
        $atr = array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($atr);
        $auth = Auth::user()->username;
        return redirect('/posts/' . $auth . '/myposts')->with('success', 'Post Created!');
    }

    public function create()
    {
        return view('dashboard.posts.create');
    }

    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $atr = $this->validatePost($post);
        $this->thumbnailDelete($post->thumbnail);
        $atr['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $post->update($atr);
        $auth = Auth::user()->username;
        return redirect('/posts/' . $auth . '/myposts')->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $trainingPost = TrainingPost::where('post_id', $post->id);
        if (!$trainingPost) $trainingPost->delete();
        $this->thumbnailDelete($post->thumbnail);
        $post->delete();
        return back()->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => ['required'],
            'excerpt' => ['required'],
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'body' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
        ]);
    }

    protected function thumbnailDelete($thumbnail)
    {
        if (file_exists(public_path('storage/' . $thumbnail))) {
            File::delete(public_path('storage/' . $thumbnail));
        }
    }

}
