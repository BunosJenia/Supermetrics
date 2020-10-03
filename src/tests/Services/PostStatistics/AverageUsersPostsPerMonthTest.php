<?php

declare(strict_types=1);

namespace Tests\Services\PostStatistics;

use App\Services\PostStatistics\AverageUsersPostsPerMonth;
use Tests\SuperMetricsTestCase;

/**
 * Class AverageUsersPostsPerMonthTest
 *
 * Test calculations of AverageUsersPostsPerMonth class.
 */
class AverageUsersPostsPerMonthTest extends SuperMetricsTestCase
{
    public function testCalculations()
    {
        $instance = new AverageUsersPostsPerMonth();
        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->combine($post);
        }

        $result = $instance->getResult();

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Average number of posts per user per month":{"user_id1":{"June":12,"July":12,"September":12},"user_id2":{"June":12,"July":12,"September":12},"user_id3":{"July":16,"September":12}}}',
            json_encode($result)
        );
    }
}