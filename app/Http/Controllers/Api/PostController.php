<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(public Logger $logger)
    {
    }

    public function index(): JsonResponse
    {
        $posts = Post::all()->load(['author', 'comments'])->take(10);

        return Response::json($posts);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        try {
            $post = new Post();

            $post->title = $request->get('title');
            $post->slug = Str::slug($request->get('title'));
            $post->user_id = Auth::user()->id;
            $post->content = strip_tags($request->get('content'));

            $post->save();

            return Response::json($post);
        } catch (UniqueConstraintViolationException $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());

            return Response::json(['errors' => ['message' => 'Title already exist.']], 400);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());

            return Response::json(['errors' => ['message' => 'We can not proceed your request.']], 500);
        }
    }
}
