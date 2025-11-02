<?php

namespace Modules\Post\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Transformers\UserResource;
use Modules\Comment\Transformers\CommentResource;
use Modules\Like\Transformers\LikeResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'featured_image' => ResourceHelper::getFirstMediaOriginalUrl($this, 'featured_image'), // Also fixed the collection name here

            // Counts
            'likes_count' => $this->likes_count ?? $this->whenCounted('likes', 0),
            'comments_count' => $this->comments_count ?? $this->whenCounted('comments', 0),

            // User relationship - FIXED: use new UserResource for single relationship
            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'likes' => LikeResource::collection($this->whenLoaded('likes')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
