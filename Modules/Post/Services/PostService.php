<?php

namespace Modules\Post\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Post\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts(int $perPage = 15)
    {
        return $this->postRepository->getAllPaginated($perPage);
    }

    public function getPostById($id)
    {
        return $this->postRepository->findById($id, ['user', 'comments.user', 'likes.user']);
    }
}
