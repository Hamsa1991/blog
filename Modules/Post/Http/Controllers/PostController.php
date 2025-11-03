<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Modules\Post\Http\Requests\PostRequest;
use Modules\Post\Services\PostService;
use Modules\Post\Transformers\PostResource;

class PostController extends Controller
{

    use HttpResponse;
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts(15);
        return $this->paginatedResponse($posts, PostResource::class);
    }

    public function show($id)
    {
        try {
            $post = $this->postService->getPostById($id);
            return $this->successResponse(PostResource::make($post));
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
    public function store(PostRequest $request)
    {
        try {
            $post = $this->postService->createPost($request->validated());
            return $this->successResponse(PostResource::make($post));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
