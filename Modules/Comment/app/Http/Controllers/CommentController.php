<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Comment\Services\CommentService;
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

    public function getPostComments(int $id)
    {
        try {
            $post = $this->commnetService->getPostComments($id, 15)
        return $this->successResponse(CommentResource::make($post));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function store(CommentRequest $request, $id)
    {
        try {
            $comment = $this->commnetService->createComment($request->validated(), $id);
            return $this->successResponse(CommentResource::make($comment));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

}
