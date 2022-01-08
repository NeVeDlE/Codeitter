<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Follow extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function check($user): bool
    {
        return (bool)Rule::unique('follows')->where(function ($query) use ($user) {
                return $query->where('followed', $user->id)->where('followed_by', auth()->id());
            }) && auth()->id() != $user->id;
    }


}
