<?php

declare(strict_types=1);

use App\Services\PostStatistics\LongestPostPerMonth;
use Tests\SuperMetricsTestCase;

class LongestPostPerMonthTest extends SuperMetricsTestCase
{
    public function testValidPosts()
    {
        $instance = new LongestPostPerMonth();

        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->calculate($post);
        }

        $this->assertEquals(
            '{"Longest post by character length per month":{"June":16,"July":16,"September":16}}',
            $instance->getResultMessage()
        );
    }
}