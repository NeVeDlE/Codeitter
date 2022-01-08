<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class FollowController extends Controller
{
    public function store(User $user)
    {
        if (Follow::check($user)) {

            Follow::create([
                'followed' => $user->id,
                'followed_by' => auth()->id(),
            ]);
            return back()->with('success', 'You have followed ' . $user->username . ' successfully');
        }
        throw ValidationException::withMessages(['follow' => 'You already followed this person']);
    }

    public function destroy(User $user)
    {

        Follow::where('followed', $user->id)->where('followed_by', auth()->id())->delete();

        return back()->with('success', 'You have unfollowed ' . $user->username . ' successfully');
    }

}
