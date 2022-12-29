<?php

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return UserResource::collection(User::all());
});

Route::get('/posts', function () {
    return PostResource::collection(Post::all());
});

Route::get('/posts/{post}/users', function (Post $post) {
    $users = User::WhereHas('comments', function($query) use($post) {
        $query->wherePostId($post->id);
    })->get();
    return UserResource::collection($users);
});

Route::get('/comments', function () {
    return CommentResource::collection(Comment::all());
});

