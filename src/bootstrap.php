<?php

declare(strict_types = 1);

use App\Services\PostFetcher;
use App\Services\PostStatistics\ServiceLocator;
use App\Services\PostStatistics\AverageUsersPostsPerMonth;
use App\Services\PostStatistics\AveragePostLengthPerMonth;
use App\Services\PostStatistics\LongestPostPerMonth;
use App\Services\PostStatistics\PostsPerWeek;

require __DIR__ . '/../vendor/autoload.php';

$postFetcher = new PostFetcher();
$serviceLocator = new ServiceLocator(
//    new AverageUsersPostsPerMonth(),
//    new AveragePostLengthPerMonth(),
//    new LongestPostPerMonth(),
//    new PostsPerWeek()
);

$serviceLocator->addService(new AverageUsersPostsPerMonth());
//$serviceLocator->addService(new AveragePostLengthPerMonth());
//$serviceLocator->addService(new LongestPostPerMonth());
//$serviceLocator->addService(new PostsPerWeek());

var_dump($serviceLocator->locate($postFetcher->getPosts()));