<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke(User $user)
    {
       return view('profile.index',[
           'user'=>$user,
           'posts'=>Post::where('user_id',$user->id)->paginate(6),
       ]);

    }
}
