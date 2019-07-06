<?php

namespace App\Http\Controllers;

use App\Filters\PostsFilter;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
     * Fetch filtered posts that have an online status
     * @return PostCollection
     */
    public function index()
    {
        $filteredPosts  = $this->filter->apply(
            request()->all(),
            Post::online()->latest()
        );

        $posts = $filteredPosts->paginate(7);

        return new PostCollection($posts);
    }

    /**
     * Fetch all posts (online or not)
     */
    public function all()
    {
        return new PostCollection(Post::latest()->get());
    }


    /**
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        $data = $request->data();
        $data["cover_path"] = $this->uploadCover($request->file("cover"));
        $data["visits"] = 0;

        $post = Post::create($data);

        $tagsId = Tag::add(explode(",", $request->tags));
        $post->tags()->attach($tagsId);

        return new PostResource($post);
    }

    private function uploadCover(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();

        $file->storeAs("public/covers", $filename);

        return asset("storage/covers/". $filename);
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return PostResource
     *
     */
    public function show(Category $category, Post $post) : PostResource
    {
        if(! auth()->user()) {
            $post->increment("visits");
        }

        $post->load(["category", "creator", "comments"]);

        return new PostResource($post);
    }


    /**
     * @param PostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostRequest $request, Post $post) : PostResource
    {
        $data = $request->data();

        if($request->file("cover")) {
            Storage::delete("public/covers/" . $post->cover);

            $data["cover_path"] = $this->uploadCover($request->file("cover"));
        }

        $post->update($data);

        $tagsId = Tag::add(explode(",", $request->tags));
        $post->tags()->sync($tagsId);

        return new PostResource($post);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Storage::delete("public/covers/{$post->cover}");

        return response()->json([], 204);
    }
}
