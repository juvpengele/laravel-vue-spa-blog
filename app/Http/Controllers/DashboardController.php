<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $viewsCount = Post::sum('visits');

        $popularPosts = Post::with('category')->orderBy('visits', 'DESC')->take(5)->get();
        $latestComments = Comment::with('post')->take(5)->get();

        return response()->json([
            'data' => compact('postsCount', 'commentsCount', 'viewsCount', 'popularPosts', 'latestComments')
        ]);

    }
}
