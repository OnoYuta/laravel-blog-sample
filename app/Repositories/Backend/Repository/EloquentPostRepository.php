<?php

namespace App\Repositories\Backend\Repository;

use App\Models\Post;
use App\Repositories\Backend\Contract\PostRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentPostRepository implements PostRepositoryContract
{
    /**
     * Return Post by passed id
     *
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        $post = Post::find($id);

        if (! is_null($post)) {
            return $post;
        }

        throw new ModelNotFoundException();
    }
}
