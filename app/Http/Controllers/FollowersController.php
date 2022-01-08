<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{

    public function __invoke()
    {
        return view('dashboard.connections.followers', [
            'followers' => Auth::User()->followers,
            'following' => Auth::User()->following
        ]);
    }
}
