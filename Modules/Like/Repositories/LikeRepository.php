<?php

namespace App\Modules\Like\Repositories;

use App\Modules\Like\Models\Like;
use App\Modules\Like\Repositories\Contracts\LikeRepositoryInterface;
use App\Modules\Post\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentLikeRepository implements LikeRepositoryInterface
{
    public function __construct(
        private Like $like
    ) {}

/**
 * Toggle like for a post (like/unlike)
 */
public function toggleLike(int $userId, int $postId): array
{
    $existingLike = $this->userHasLikedPost($userId, $postId);

    if ($existingLike) {
        $this->unlikePost($userId, $postId);
        $liked = false;
    } else {
        $this->likePost($userId, $postId);
        $liked = true;
    }

    $likeCount = $this->getLikeCount($postId);

    return [
        'liked' => $liked,
        'like_count' => $likeCount
    ];
}

/**
 * Get like count for a post
 */
public function getLikeCount(int $postId): int
{
    return $this->like->where('post_id', $postId)->count();
}

/**
 * Check if user can like their own post
 */
public function canUserLikeOwnPost(int $userId, int $postId): bool
{
    $post = Post::find($postId);

    if (!$post) {
        return false;
    }

    return $post->user_id !== $userId;
}

}
}
