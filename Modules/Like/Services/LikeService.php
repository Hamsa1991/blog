<?php

namespace Modules\Like\Services;

use Modules\Like\Models\Like;
use Modules\Like\Repositories\LikeRepository;
use Modules\Post\Repositories\PostRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LikeService
{
    public function __construct(
        private LikeRepository $likeRepository,
        private PostRepository $postRepository
    ) {}

/**
 * Toggle like for a post
 */
public function toggleLike(int $postId, int $userId): array
{
    // Check if post exists
    $post = $this->postRepository->findById($postId);
    if (!$post) {
        throw new ModelNotFoundException('Post not found');
    }

    // Check if user is trying to like their own post
    if (!$this->likeRepository->canUserLikeOwnPost($userId, $postId)) {
        throw new \InvalidArgumentException('You cannot like your own post');
    }

    return $this->likeRepository->toggleLike($userId, $postId);
}

/**
 * Get like count for a post
 */
public function getPostLikes($postId): int
{
    if (!$this->postRepository->findById($postId)) {
        throw new ModelNotFoundException('Post not found');
    }

    return $this->likeRepository->getLikeCount($postId);
}


/**
 * Check if user can like a post
 */
public function canUserLikePost(int $postId, int $userId): bool
{
    if (!$this->postRepository->findById($postId)) {
        return false;
    }

    return $this->likeRepository->canUserLikeOwnPost($userId, $postId) &&
        !$this->likeRepository->userHasLikedPost($userId, $postId);
}

}
