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

Route::get('/statistics', 'DashboardController@index');

/*
    |--------------------------------------------------------------------------
    | Posts routes
    |--------------------------------------------------------------------------
*/
Route::get("/posts/all", "PostsController@all");
Route::resource("posts", "PostsController")->names([
    "index" => "api.posts.index",
    "store"  => "api.posts.store",
    "edit" => "api.posts.edit",
    "update" => "api.posts.update",
    "destroy" => "api.posts.destroy",
]);

Route::get("{category}/{post}", "PostsController@show")->name("api.posts.show");

/*
    |--------------------------------------------------------------------------
    | Comments routes
    |--------------------------------------------------------------------------
*/
Route::get("/comments", "CommentsController@index")->name("api.comments.index");
Route::post("{category}/{post}/comments", "CommentsController@store")->name("api.comments.store");
Route::delete("comments/{comment}", "CommentsController@destroy")->name("api.comments.destroy");

/*
    |--------------------------------------------------------------------------
    | Categories routes
    |--------------------------------------------------------------------------
    |
*/

Route::apiResource("categories", "CategoriesController")->names([
    "index" => "api.categories.index",
    "store"  => "api.categories.store",
    "show" => "api.categories.show",
    "update" => "api.categories.update",
    "destroy" => "api.categories.destroy",
]);
Route::get("/categories/{category}/posts", "CategoriesController@getPosts")->name("api.categories.posts");


/*
    |--------------------------------------------------------------------------
    | Tags routes
    |--------------------------------------------------------------------------
*/
Route::apiResource("tags", "TagsController")->names([
    "index"     => "api.tags.index",
    "show"      => "api.tags.show",
    "update"    => "api.tags.update",
    "destroy"   => "api.tags.destroy",
])->except(["store"]);
Route::get("/tags/{tag}/posts", "TagsController@getPosts")->name("api.tags.posts");




Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name("auth.login");
    Route::post('logout', 'AuthController@logout')->name("auth.logout");
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});