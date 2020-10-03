<?php

declare(strict_types = 1);

use App\Exceptions\APIException;
use App\Services\API\PostFetcher;
use App\Services\API\TokenFetcher;
use App\Services\PostStatistics\ServiceLocator;
use App\Services\PostStatistics\AverageUsersPostsPerMonth;
use App\Services\PostStatistics\AveragePostLengthPerMonth;
use App\Services\PostStatistics\LongestPostPerMonth;
use App\Services\PostStatistics\PostsPerWeek;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

require __DIR__ . '/../vendor/autoload.php';

$client = new Client(['base_uri' => SUPERMETRICS_BASE_URL]);
$tokenFetcher = new TokenFetcher($client);
$postFetcher = new PostFetcher($client, $tokenFetcher);

$serviceLocator = new ServiceLocator();

// Add needed services to ServiceLocator
$serviceLocator->addService(new AverageUsersPostsPerMonth());
$serviceLocator->addService(new AveragePostLengthPerMonth());
$serviceLocator->addService(new LongestPostPerMonth());
$serviceLocator->addService(new PostsPerWeek());

try {
    // Get All Posts and Locate Data
    var_dump(json_encode($serviceLocator->locate($postFetcher->getPosts())));
} catch (APIException $exception) {
    var_dump($exception->getMessage());
}
