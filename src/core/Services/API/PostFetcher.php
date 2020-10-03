<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Models\Post;
use GuzzleHttp\Client as GuzzleClient;
use \App\Exceptions\APIException;

/**
 * Class PostFetcher
 *
 * Service for getting posts from Supermetrics API.
 */
class PostFetcher extends Client
{
    private const GET_POSTS_URL_TEMPLATE = "assignment/posts";
    private const START_PAGE = 1;
    private const FINISH_PAGE = 10;

    /** @var TokenFetcher $tokenFetcher */
    private TokenFetcher $tokenFetcher;

    /**
     * PostFetcher constructor.
     *
     * @param GuzzleClient $client
     * @param TokenFetcher $tokenFetcher
     */
    public function __construct(GuzzleClient $client, TokenFetcher $tokenFetcher)
    {
        parent::__construct($client);

        $this->tokenFetcher = $tokenFetcher;
    }

    /**
     * Get Posts from API and transform them to convenient objects.
     *
     * @return array
     *
     * @throws APIException
     */
    function getPosts() {
        $allPosts = [];

        for($i = self::START_PAGE; $i <= self::FINISH_PAGE; $i++) {
            $options = [
                "query" => [
                    "sl_token" => $this->tokenFetcher->getToken(),
                    "page" => $i
                ]
            ];

            $response = $this->sendRequest(self::GET_METHOD, self::GET_POSTS_URL_TEMPLATE, $options);

            foreach ($response['data']['posts'] as $post) {
                $allPosts[] = new Post(
                    $post["from_id"],
                    $post["from_name"],
                    $post["message"],
                    new \DateTime($post["created_time"])
                );
            }
        }

        return $allPosts;
    }
}