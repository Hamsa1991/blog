<?php

namespace Modules\Post\Repositories;


use App\Services\ImageService;
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

    public function findById($id, array $with = []): ?Post
    {
        $query = $this->post->withCount(['likes', 'comments']);

        if (!empty($with)) {
            $query->with($with);
        }

        return $query->find($id);
    }
    public function createPost($data){
        if (isset($data['image'])) {
            $imageService = new ImageService($this->post, $data);
            $imageService->storeOneMediaFromRequest('featured_image', 'featured_image');
        }
        return $this->post->create($data);
    }
}
