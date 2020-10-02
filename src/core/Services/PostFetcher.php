<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;

class PostFetcher
{

    /**
     * @return array []Post
     */
    function getPosts(): array
    {
        return [new Post('', '', '', new \DateTime())];
    }
}