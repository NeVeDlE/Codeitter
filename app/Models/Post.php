<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $with = ['author'];
    protected $guarded = [];

    public function scopeDiscover($query)
    {
        $query->withCount('likes')->orderBy('likes_count', 'desc')->with('likes');
    }

    public function scopeFilter($query, $search)
    {
        $query->when($search ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%');
            });
        });
    }

    public function scopeNewsfeed($query)
    {
        $connections = Auth::User()->following;
        $ids[] = auth()->id();
        foreach ($connections as $connection){
            $ids[]=$connection->id;
        }
        $trainings = Auth::User()->trainings;
        foreach ($trainings as $training) {
           foreach ($training->posts as $post){
               $ids[]=$post->user_id;
           }
        }
        $query->latest()->whereIn('user_id', $ids);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function trainingpost()
    {
        return $this->belongsTo(TrainingPost::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function viewes()
    {
        return $this->hasMany(View::class, 'post_id');
    }
}
