<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyPostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TrainingPostController;
use App\Http\Controllers\TrainingMembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscoverUsersController;
use App\Http\Controllers\DiscoverTrainingController;
use App\Http\Controllers\DiscoverPostsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/sessions', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/posts/{user:username}/myposts', [MyPostController::class, 'index'])->name('myPosts');
    Route::get('/posts/{user:username}/myposts/create', [MyPostController::class, 'create'])->name('createPosts');
    Route::post('/posts/{user:username}/myposts', [MyPostController::class, 'store']);

    Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings');
    Route::get('/trainings/create', [TrainingController::class, 'create'])->name('training-create');
    Route::post('/trainings', [TrainingController::class, 'store']);

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
    Route::patch('/settings', [SettingsController::class, 'update']);

    Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store']);

    Route::post('/posts/{post:slug}/like', [LikeController::class, 'store']);
    Route::delete('/posts/{post:slug}/like', [LikeController::class, 'destroy']);

    Route::post('/logout', [SessionsController::class, 'destroy']);

    Route::get('/trainings/{training:slug}/members', [TrainingmembersController::class, 'index'])->name('training-members');
    Route::get('/trainings/{training:slug}/members/showOwner', [TrainingmembersController::class, 'show'])->name('training-owner');
    Route::get('/trainings/{training:slug}/members/create', [TrainingmembersController::class, 'create'])->name('training-join');
    Route::post('/trainings/{training:slug}/members', [TrainingmembersController::class, 'store']);

    Route::get('/connections/followers', FollowersController::class)->name('followers');
    Route::get('/connections/following', FollowingController::class)->name('following');
    Route::post('/connections/follow/{user:username}', [FollowController::class, 'store']);
    Route::delete('/connections/unfollow/{user:username}', [FollowController::class, 'destroy']);

    Route::get('/profile/{user:username}', ProfileController::class);

    Route::get('/discover/users', DiscoverUsersController::class)->name('discover-users');
    Route::get('/discover/trainings', DiscoverTrainingController::class)->name('discover-trainings');
    Route::get('/discover/posts', DiscoverPostsController::class)->name('discover-posts');

    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/{user:username}', [MessageController::class, 'show']);
    Route::post('/messages/{user:username}', [MessageController::class, 'store']);

    Route::get('/trainings/posts/{post:slug}/show', [TrainingPostController::class, 'show']);

    Route::get('/search', SearchController::class);
});

Route::middleware('can:postOwner,post')->group(function () {
    Route::get('/posts/myposts/{post:id}/edit', [MyPostController::class, 'edit']);
    Route::patch('/posts/myposts/{post:id}/update', [MyPostController::class, 'update']);
    Route::delete('/posts/myposts/{post:id}/delete', [MyPostController::class, 'destroy']);
});

Route::middleware('can:trainingMember,training')->group(function () {
    Route::get('/trainings/{training:slug}/posts', [TrainingPostController::class, 'index'])->name('training-posts');
    Route::get('/trainings/{training:slug}/posts/create', [TrainingPostController::class, 'create'])->name('trainingCreatePosts');
    Route::post('/trainings/{training:slug}/posts/store', [TrainingPostController::class, 'store']);


    Route::get('/trainings/{training:slug}/topics', [TopicController::class, 'index'])->name('topics');
});

Route::middleware('can:trainingOwner,training')->group(function () {
    Route::get('/trainings/{training:slug}/members/{member:id}', [TrainingmembersController::class, 'edit']);
    Route::patch('/trainings/{training:slug}/members/{member:id}', [TrainingmembersController::class, 'update']);
    Route::delete('/trainings/{training:slug}/members/{member:id}', [TrainingmembersController::class, 'destroy']);

    Route::get('/trainings/{training:slug}/topics/create', [TopicController::class, 'create'])->name('topics-create');
    Route::post('/trainings/{training:slug}/topics/', [TopicController::class, 'store']);
    Route::get('/trainings/{training:slug}/topics/edit/{topic:name}', [TopicController::class, 'edit']);
    Route::patch('/trainings/{training:slug}/topics/update/{topic:name}', [TopicController::class, 'update']);
    Route::delete('/trainings/{training:slug}/topics/delete/{topic:name}', [TopicController::class, 'destroy']);

    Route::get('/trainings/edit/{training:slug}', [TrainingController::class, 'edit']);
    Route::patch('/trainings/{training:slug}', [TrainingController::class, 'update']);
    Route::delete('/trainings/{training:slug}', [TrainingController::class, 'destroy']);
});
