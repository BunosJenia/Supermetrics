<?php

declare(strict_types = 1);

use App\Services\Cache\SimpleCacheClient;
use App\Exceptions\APIException;
use App\Services\API\PostFetcher;
use App\Services\API\TokenFetcher;
use App\Services\PostStatistics\PostStatisticsFetcher;
use App\Services\PostStatistics\AverageUsersPostsPerMonth;
use App\Services\PostStatistics\AveragePostLengthPerMonth;
use App\Services\PostStatistics\LongestPostPerMonth;
use App\Services\PostStatistics\PostsPerWeek;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$client = new Client(['base_uri' => SUPERMETRICS_BASE_URL]);
$cacheClient = new SimpleCacheClient();
$tokenFetcher = new TokenFetcher($client, $cacheClient);
$postFetcher = new PostFetcher($client, $tokenFetcher);

$serviceLocator = new PostStatisticsFetcher();

// Add needed services to PostStatisticsFetcher
$serviceLocator->addService(new AverageUsersPostsPerMonth());
$serviceLocator->addService(new AveragePostLengthPerMonth());
$serviceLocator->addService(new LongestPostPerMonth());
$serviceLocator->addService(new PostsPerWeek());

try {
    // Get All Posts and Locate Data
    var_dump(json_encode($serviceLocator->fetch($postFetcher->getPosts())));
} catch (APIException $exception) {
    var_dump($exception->getMessage());
}
