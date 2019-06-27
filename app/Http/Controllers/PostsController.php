<?php

namespace App\Http\Controllers;

use App\Filters\PostsFilter;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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
     * @return PostCollection
     */
    public function index()
    {
        $filteredPosts  = $this->filter->apply(
            request()->all(),
            Post::latest()
        );

        $posts = $filteredPosts->paginate(7);

        return new PostCollection($posts);
    }


    /**
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {

        $data = $request->data();
        $data["cover_path"] = $this->uploadCover($request->file("cover"));

        $post = Post::create($data);

        return new PostResource($post);
    }

    private function uploadCover(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();

        $file->storeAs("public/covers", $filename);

        return storage_path("public/covers". $filename);
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return PostResource
     *
     */
    public function show(Category $category, Post $post)
    {
        $post->increment("visits");

        $post->load(["category", "creator", "comments"]);

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
