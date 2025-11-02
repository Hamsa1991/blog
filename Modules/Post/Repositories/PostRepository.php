<?php

namespace Modules\Blog\Repositories;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Post\Models\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->post
            ->with(['user:id,name,email'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id, array $with = []): ?Post
    {
        $query = $this->post->withCount(['likes', 'comments']);

        if (!empty($with)) {
            $query->with($with);
        }

        return $query->find($id);
    }
}
