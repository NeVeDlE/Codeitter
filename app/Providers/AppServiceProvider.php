<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('postOwner', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('trainingOwner', function (User $user, Training $training) {
            return $user->id === $training->user_id;
        });

        Gate::define('trainingMember', function (User $user, Training $training) {
            foreach ($training->members as $member) {
                if ($user->id == $member->user_id) return true;
            }
            return false;
        });
    }
}
