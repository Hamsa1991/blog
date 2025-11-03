<?php

namespace Modules\Like\Repositories;

use Modules\Like\Models\Like;
use Modules\Like\Repositories\LikeRepositoryInterface;
use Modules\Post\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    public function __construct(
        private Like $like
    ) {}

public function likePost(int $userId, int $postId): bool
{
    // Check if user has already liked the post
    if ($this->userHasLikedPost($userId, $postId)) {
        return false;
    }

    // Create new like
    $like = new Like();
    $like->user_id = $userId;
    $like->post_id = $postId;

    return $like->save();
}

public function unlikePost(int $userId, int $postId): bool
{
    $like = $this->like
        ->where('user_id', $userId)
        ->where('post_id', $postId)
        ->first();

    if ($like) {
        return $like->delete();
    }

    return false;
}
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
public function getLikeCount($postId): int
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

public function userHasLikedPost(int $userId, int $postId): bool
{
    return $this->like->where('post_id', $postId)->count() >= 1;
}
}
