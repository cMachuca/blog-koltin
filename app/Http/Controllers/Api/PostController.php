<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $posts = Post::all()->load(['author', 'comments'])->take(10);

        return Response::json($posts);
    }


    public function store(StorePostRequest $request): JsonResponse
    {
        $post = new Post();

        $post->title = $request->get('title');
        $post->slug = Str::slug($request->get('title'));
        $post->user_id = Auth::user()->id;
        $post->content = strip_tags($request->get('content'));

        $post->save();

        return Response::json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
