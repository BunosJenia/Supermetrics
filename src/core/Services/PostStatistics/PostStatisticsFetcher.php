<?php

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class PostStatisticsFetcher
 *
 * Combine and calculate data for services.
 */
class PostStatisticsFetcher
{
    /** @var AbstractPostsStatistics[] */
    private array $services = [];

    /**
     * Add service for usage.
     *
     * @param AbstractPostsStatistics $service
     */
    public function addService(AbstractPostsStatistics $service)
    {
        $this->services[] = $service;
    }

    /**
     * @param Post[] $posts
     *
     * @return array
     */
    public function fetch(array $posts): array
    {
        $resultMessageArray = [];

        foreach ($this->services as $service) {
            foreach ($posts as $post) {
                $service->combine($post);
            }

            $resultMessageArray = array_merge($resultMessageArray, $service->getResult());
        }

        return $resultMessageArray;
    }
}