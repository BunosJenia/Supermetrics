<?php

declare(strict_types=1);

use App\Services\PostStatistics\AverageUsersPostsPerMonth;
use Tests\SuperMetricsTestCase;

class AverageUsersPostsPerMonthTest extends SuperMetricsTestCase
{
    public function testValidPosts()
    {
        $instance = new AverageUsersPostsPerMonth();

        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->calculate($post);
        }

        $this->assertEquals(
            '{"Average number of posts per user per month":{"user_id1":{"June":12,"July":12,"September":12},"user_id2":{"June":12,"July":12,"September":12},"user_id3":{"July":16,"September":12}}}',
            $instance->getResultMessage()
        );
    }
}