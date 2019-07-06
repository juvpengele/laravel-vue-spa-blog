<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api')->only(["update", "destroy"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TagResource::collection(
            Tag::withCount("posts")->get()
        );
    }


    /**
     * Display the tag resource.
     *
     * @param Tag $tag
     * @return TagResource
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Update the tag resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Tag $tag
     * @return TagResource
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate(["name" => "required"]);
        if($request->name !== $tag->name) {
            $request->validate(["name" => "unique:tags"]);
        }

        $tag->update([
            "name" => $request->name,
            "title" => Str::slug($request->name)
        ]);

        return new TagResource($tag);
    }

    /**
     * Remove a tag resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([], 204);
    }


    /**
     * @param Tag $tag
     * @return PostCollection
     */
    public function getPosts(Tag $tag)
    {
        $posts = $tag->posts()->online()->paginate(10);

        return new PostCollection($posts);
    }
}
