<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index', [
            'users' => User::messagesUsers()->simplePaginate(10),
        ]);
    }

    public function show(User $user)
    {
        return view('messages.show', [
            'messages' => Message::Filter($user)->latest()->paginate(10),
            'sender' => $user,
        ]);
    }

    public function store(User $user)
    {
        $atr = array_merge(request()->validate([
            'body' => ['required']
        ]), [
            'sender' => auth()->id(),
            'receiver' => $user->id,
            'viewed' => 0,
        ]);

        Message::create($atr);
        return back()->with('success', 'Your message has been sent');

    }

}
