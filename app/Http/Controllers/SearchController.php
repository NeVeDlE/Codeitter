<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {
        return view('search.search-index', [
            'posts' => Post::filter(request('search'))->paginate(10, ['*'], 'postResults')->withQueryString(),
            'users' => User::filter(request('search'))->paginate(10, ['*'], 'userPage')->withQueryString(),
            'trainings' => Training::filter(request('search'))->paginate(10, ['*'], 'userPage')->withQueryString()
        ]);
    }
}
