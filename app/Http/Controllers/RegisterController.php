<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $atr = request()->validate([
            'name' => ['required', 'max:255', 'min:2'],
            'username' => ['required', 'max:255', 'min:4', Rule::unique('users', 'username')],
            'email' => ['email', 'max:255', 'required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:255'],
            'thumbnail' => ['image'],
            'handle'=>['min:2','max:255',Rule::unique('users','handle')],
        ]);
        isset(request()->thumbnail) ? $atr['thumbnail'] = request()->file('thumbnail')->store('thumbnails') : $atr['thumbnail']='thumbnails/default.jpg';
        auth()->login(User::create($atr));
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
