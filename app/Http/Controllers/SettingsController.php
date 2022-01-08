<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;


class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings.edit');
    }

    public function update()
    {

        $atr = request()->validate([
            'username' => ['required', 'max:255', 'min:4', Rule::unique('users', 'username')->ignore(auth()->id())],
            'email' => ['email', 'max:255', 'required', Rule::unique('users', 'email')->ignore(auth()->id())],
            'handle'=>['min:2','max:255',Rule::unique('users','handle')->ignore(auth()->id())],
            'thumbnail' => ['image'],
        ]);

        if (isset($atr['thumbnail'])) {
            $this->thumbnailDelete(Auth::User()->thumbnail);
            $atr['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        Auth::User()->update($atr);

        return redirect('/')->with('success', 'Your account has been Updated.');
    }

    protected function thumbnailDelete($thumbnail)
    {
        if (file_exists(public_path('storage/' . $thumbnail))) {
            File::delete(public_path('storage/' . $thumbnail));
        }
    }

}
