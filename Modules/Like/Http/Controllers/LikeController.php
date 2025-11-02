<?php

namespace Modules\Like\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Like\Services\LikeService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Modules\Like\Http\Requests\LikeRequest;
use Modules\Like\Transformers\LikeResource;

class LikeController extends Controller
{
    use HttpResponse;
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function getPostLikes(int $id)
    {
        try {
            $post = $this->likeService->getPostLikes($id, 15);
            return $this->successResponse(LikeResource::make($post));
         }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function toggleLike($id){
        try {
            $comment = $this->likeService->toggleLike($id, auth()->user()->id);
            return $this->successResponse(LikeResource::make($comment));
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
}
