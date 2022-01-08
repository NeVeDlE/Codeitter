<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likedBy($post_id): array
    {
        $likes = Like::where('post_id', $post_id)->get();
        $liked = false;
        foreach ($likes as $like) {
            if($like->user_id==auth()->id()){
                $liked=true;
                break;
            }
        };
        $count = $likes->count();
        return [
            $liked,
            $count
        ];
    }

}
