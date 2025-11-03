<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Models\Comment;
use Modules\Comment\Repositories\CommentRepositoryInterface;
use Modules\Post\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(
        private Comment $comment
    ) {}

/**
 * Get paginated comments for a post
 */
public function getPostComments(int $postId)
{
    return $this->comment->with('user')
        ->where('post_id', $postId)
        ->orderBy('created_at', 'desc')
        ->paginate(15);
}

public function create(array $data): Comment
{
    return $this->comment->create($data);
}


}
