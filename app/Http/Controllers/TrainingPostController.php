<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Training;
use App\Models\TrainingPost;
use App\Models\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Post;

class TrainingPostController extends Controller
{
    public function index(Training $training)
    {
        $posts_ids = TrainingPost::where('training_id', $training->id)->get();
        $ids = $posts_ids->map(function ($post) {
            return $post->post_id;
        });
        return view('dashboard.admin-trainings.posts.index', [
            'posts' => Post::whereIn('id', $ids)->paginate(6),
            'training' => $training
        ]);

    }

    public function show(Post $post)
    {
        $like = Like::likedBy($post->id);
        return view('dashboard.admin-trainings.posts.show', [
            'post' => $post,
            'liked' => $like[0],
            'likes_count' => $like[1],
            'views_count' => View::ViewedBy($post->id),
            'training' => TrainingPost::where('post_id', $post->id)->first()->training,
        ]);

    }
    public function create(Training $training)
    {
        //if user belongs to this training
        return view('dashboard.admin-trainings.posts.create', [
            'training' => $training,
        ]);

    }

    public function store(Training $training)
    {
        $atr = array_merge($this->validatePost(), [
            'slug' => $this->generateSlug(request()->title),
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);
        $post = Post::create($atr);
        TrainingPost::create([
            'post_id' => $post->id,
            'training_id' => $training->id,
        ]);
        return redirect('/trainings/' . $training->slug . '/posts')->with('success', 'Your post has been published');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => ['required'],
            'excerpt' => ['required'],
            'thumbnail' => ['image'],
            'body' => 'required',
        ]);
    }

    protected function generateSlug($name): string
    {
        $name = Str::slug($name);
        $id = 1;
        $slug = $name;
        while (Validator::make(['slug' => $slug], [
            'slug' => [Rule::unique('posts', 'slug')],
        ])->fails()) {
            $slug = $name . $id++;
        };

        return $slug;
    }

}
