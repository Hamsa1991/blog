<?php

namespace Modules\Post\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Blog\Repositories\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(int $perPage = 15): LengthAwarePaginator
    {
        return $this->postRepository->getAllPaginated($perPage);
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->findById($id, ['user', 'comments.user', 'likes.user']);
    }
}
