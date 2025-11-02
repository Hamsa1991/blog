<?php

namespace App\Modules\Comment\Repositories;

use App\Modules\Comment\Models\Comment;
use App\Modules\Comment\Repositories\Contracts\CommentRepositoryInterface;
use App\Modules\Post\Models\Post;
use App\Modules\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        private Comment $comment
    ) {}

/**
 * Get paginated comments for a post
 */
public function getPostComments(int $postId, int $perPage = 15): LengthAwarePaginator
{
    return $this->comment->with('user')
        ->where('post_id', $postId)
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
}

public function create(array $data): Comment
{
    return $this->comment->create($data);
}


}
