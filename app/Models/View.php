<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function viewedBy($post_id)
    {
        $views = View::where('post_id', $post_id)->get();
        if (\Auth::check()) {
            $bool = false;
            foreach ($views as $view) {
                if ($view->user_id == auth()->id()) {
                    $bool = true;
                    break;
                }
            }
            $views = $views->count();
            if (!$bool) {
                View::create([
                    'user_id' => auth()->id(),
                    'post_id' => $post_id
                ]);
                $views++;
            }
            return $views;
        }
        return $views->count();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(User::class, 'post_id');
    }
}
