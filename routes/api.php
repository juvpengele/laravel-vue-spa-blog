<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("posts", "PostsController")->names([
    "index" => "api.posts.index",
    "store"  => "api.posts.store",
    "create" => "api.posts.create",
    "edit" => "api.posts.edit",
    "update" => "api.posts.update",
    "destroy" => "api.posts.destroy",
]);

Route::get("{category}/{post}", "PostsController@show")->name("api.posts.show");