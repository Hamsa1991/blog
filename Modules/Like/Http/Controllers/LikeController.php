<?php

namespace Modules\Like\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Like\Services\LikeService;
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

    public function getPostLikes($id)
    {
        try {
            $likes = $this->likeService->getPostLikes($id);
            return $this->successResponse($likes);
         }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function toggleLike($id){
        try {
            $data = $this->likeService->toggleLike($id, auth()->user()->id);
            return $this->successResponse($data);
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }
}
