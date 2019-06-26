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
    "edit" => "api.posts.edit",
    "update" => "api.posts.update",
    "destroy" => "api.posts.destroy",
]);

Route::apiResource("categories", "CategoriesController")->names([
    "index" => "api.categories.index",
    "store"  => "api.categories.store",
    "show" => "api.categories.show",
    "update" => "api.categories.update",
    "destroy" => "api.categories.destroy",
]);
Route::get("/categories/{category}/posts", "CategoriesController@getPosts")->name("api.categories.posts");


Route::get("{category}/{post}", "PostsController@show")->name("api.posts.show");
Route::post("{category}/{post}/comments", "CommentsController@store")->name("api.comments.store");



Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name("auth.login");
    Route::post('logout', 'AuthController@logout')->name("auth.logout");
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});