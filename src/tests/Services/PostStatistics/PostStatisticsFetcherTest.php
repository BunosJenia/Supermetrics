<?php

declare(strict_types=1);

namespace Tests\Services\PostStatistics;

use App\Services\PostStatistics\PostStatisticsFetcher;
use App\Services\PostStatistics\AveragePostLengthPerMonth;
use App\Services\PostStatistics\LongestPostPerMonth;
use App\Services\PostStatistics\PostsPerWeek;
use Tests\SuperMetricsTestCase;

class PostStatisticsFetcherTest extends SuperMetricsTestCase
{
    public function testOneServiceForLocator()
    {
        $serviceLocator = new PostStatisticsFetcher();
        $serviceLocator->addService(new AveragePostLengthPerMonth);

        $result = $serviceLocator->fetch($this->getPosts());

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Average character length of posts per month":{"June":12,"July":12.8,"September":12}}',
            json_encode($result)
        );
    }

    public function testMultipleServicesForLocator()
    {
        $serviceLocator = new PostStatisticsFetcher();
        $serviceLocator->addService(new AveragePostLengthPerMonth);
        $serviceLocator->addService(new LongestPostPerMonth);
        $serviceLocator->addService(new PostsPerWeek());

        $result = $serviceLocator->fetch($this->getPosts());

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Average character length of posts per month":{"June":12,"July":12.8,"September":12},"Longest post by character length per month":{"June":16,"July":16,"September":16},"Total posts split by week number":{"24":4,"28":5,"37":6}}',
            json_encode($result)
        );
    }
}