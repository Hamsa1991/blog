<?php

namespace Modules\Like\Repositories;

use Modules\Like\Models\Like;
use Illuminate\Database\Eloquent\Collection;

interface LikeRepositoryInterface
{
    public function toggleLike(int $userId, int $postId): array;

    /**
     * Get like count for a post
     */
    public function getLikeCount(int $postId): int;

    /**
     * Check if user can like their own post
     */
    public function canUserLikeOwnPost(int $userId, int $postId): bool;

}
