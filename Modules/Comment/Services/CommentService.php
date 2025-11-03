<?php

namespace Modules\Comment\Services;

use Modules\Comment\Models\Comment;
use Modules\Comment\Repositories\CommentRepository;
use Modules\Post\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentService
{
    public function __construct(
        private CommentRepository $commentRepository,
        private PostRepository $postRepository
    ) {}


public function getPostComments(int $postId)
{

    if (!$this->postRepository->findById($postId)) {
        throw new ModelNotFoundException('Post not found');
    }

    return $this->commentRepository->getPostComments($postId);
}

public function createComment(array $data, int $id): Comment
{
    $post = $this->postRepository->findById($id);

    if (!$post) {
        throw new ModelNotFoundException('Post not found');
    }

    $commentData = [
        'user_id' => auth()->user()->id,
        'post_id' => $id,
        'body' => $data['body'],
    ];

    return $this->commentRepository->create($commentData);
}


}
