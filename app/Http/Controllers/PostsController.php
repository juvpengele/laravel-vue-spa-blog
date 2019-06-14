<?php

namespace App\Http\Controllers;

use App\Filters\PostsFilter;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    protected $filter;

    /**
     * PostsController constructor.
     * @param PostsFilter $filter
     */
    public function __construct(PostsFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $filteredPosts  = $this->filter->apply(
            request()->all(),
            Post::latest()
        );

        $posts = $filteredPosts->paginate(7);

        return PostResource::collection($posts);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return PostResource
     * 
     */
    public function show(Category $category, Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
