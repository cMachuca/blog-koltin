<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request, string $name): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $author = User::where('slug_name', $name)->with('comments')->first();

        return view('blog.author', ['author' => $author]);
    }
}
