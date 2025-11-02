<?php

namespace Modules\Post\Transformers;

use App\Helpers\ResourceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
//            'featured_image' => $this->featured_image ? asset('storage/' . $this->featured_image) : null,
            'featured_image' => return ResourceHelper::getFirstMediaOriginalUrl($this, 'image'),

            // Counts
            'likes_count' => $this->likes_count ?? $this->whenCounted('likes', 0),
            'comments_count' => $this->comments_count ?? $this->whenCounted('comments', 0),

            // User relationship
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'joined_at' => $this->user->created_at->format('M Y'),
            ],
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'likes' => LikeResource::collection($this->whenLoaded('likes')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
