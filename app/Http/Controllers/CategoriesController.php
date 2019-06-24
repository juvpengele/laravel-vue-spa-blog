<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     */
    public function store(Request $request)
    {
        $categoriesNames = explode(",", $request->get("names"));

        $categoriesSaved = Category::register($categoriesNames);

        return CategoryResource::collection($categoriesSaved);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([ "name" => "required|max:255"]);

        if($request->name !== $category->name) {
            $request->validate(["name" => "unique:categories"]);
        }

        $category->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name)
        ]);

        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([], 204);
    }


    public function getPosts(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(7);

        return new PostCollection($posts);
    }

}
