<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request, $name)
    {
        $author = User::where('slug_name', $name)->with('comments')->first();

        return view('blog.author', ['author' => $author]);
    }
}
