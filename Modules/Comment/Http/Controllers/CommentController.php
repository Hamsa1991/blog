<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Services\CommentService;
use App\Traits\HttpResponse;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Comment\Transformers\CommentResource;

class CommentController extends Controller
{
    use HttpResponse;
    protected $commnetService;

    public function __construct(CommentService $commnetService)
    {
        $this->commnetService = $commnetService;
    }

    public function getPostComments($postId)
    {
        try {
            $comments = $this->commnetService->getPostComments($postId);
            return $this->successResponse(CommentResource::collection($comments));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function store($id, CommentRequest $request)
    {
        try {
            $comment = $this->commnetService->createComment($request->validated(), $id);
            return $this->successResponse(CommentResource::make($comment));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

}
