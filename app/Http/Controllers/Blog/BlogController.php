<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::all()->load(['author', 'comments'])->take(10);

        return view('blog.index', ['posts' => $posts]);
    }

    public function show(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->with(['author', 'comments.user'])->first();

        return view('blog.show', ['post' => $post]);
    }
}
