<?php

namespace App\Repositories\Backend\Contract;

use App\Models\Post;

interface PostRepositoryContract
{
    /**
     * Return Post by passed id
     *
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post;
}
