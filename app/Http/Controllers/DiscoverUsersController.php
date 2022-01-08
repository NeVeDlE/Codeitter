<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DiscoverUsersController extends Controller
{
    public function __invoke()
    {
      return view('discover.users-index',[
         'users'=>User::Discover()->with('following')->paginate(10),
      ]);
    }
}
