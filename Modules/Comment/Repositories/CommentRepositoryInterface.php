<?php

namespace App\Modules\Comment\Repositories\Contracts;

use App\Modules\Comment\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    /**
     * Get paginated comments for a specific post
     */
    public function getPostComments(int $postId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Create a new comment
     */
    public function create(array $data): Comment;

}
