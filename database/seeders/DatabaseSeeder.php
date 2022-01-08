<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=User::factory()->create([
            'name'=>'Mostafa Shaher'
        ]);
        Post::factory(2)->create([
            'user_id'=>$user->id
        ]);
        Post::factory(10)->create();
        Comment::factory(10)->create();
    }
}
