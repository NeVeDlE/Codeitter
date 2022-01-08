<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }
    public function store(){
        $atr=request()->validate([
           'email'=>['required','email'],
           'password'=>['required']
        ]);
        if(auth()->attempt($atr)){
            session()->regenerate();
            return redirect('/')->with('success','Welcome Back!');
        }
        throw ValidationException::withMessages(['email'=>'Your provided credentials could not be verified.']);

    }
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success','Good Bye!');
    }
}
