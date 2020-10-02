<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;

class PostFetcher extends APIClient
{
    private const GET_POSTS_URL_TEMPLATE = "assignment/posts?sl_token=%s&page=%s";
    private const START_PAGE = 1;
    private const FINISH_PAGE = 10;

    function getPosts() {
        $allPosts = [];

        for($i = self::START_PAGE; $i <= self::FINISH_PAGE; $i++) {
            $start = microtime(true);

            $url = sprintf(
                SUPERMETRICS_BASE_URL . self::GET_POSTS_URL_TEMPLATE,
                $this->getAPIToken(),
                $i
            );

            $responseObj = $this->sendRequest($url);

            $newTime1 = microtime(true) - $start;

            foreach ($responseObj['data']['posts'] as $post) {
                $allPosts[] = new Post(
                    $post["from_id"],
                    $post["from_name"],
                    $post["message"],
                    new \DateTime($post["created_time"])
                );
            }

            $newTime2 = microtime(true) - $start;

            var_dump($start . ' - '. $newTime1 .' - '. $newTime2);
        }

        return $allPosts;
    }
}