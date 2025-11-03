<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    /**
     * Get paginated comments for a specific post
     */
    public function getPostComments(int $postId);

    /**
     * Create a new comment
     */
    public function create(array $data): Comment;

}
