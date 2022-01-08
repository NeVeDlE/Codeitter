<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function __invoke()
    {
        return view('dashboard.connections.following', [
            'following' => Auth::User()->following
        ]);
    }
}
