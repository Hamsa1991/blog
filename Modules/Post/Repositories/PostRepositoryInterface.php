<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id, array $with = []): ?Post;



}
