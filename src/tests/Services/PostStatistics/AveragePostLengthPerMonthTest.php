<?php

declare(strict_types=1);

use App\Services\PostStatistics\AveragePostLengthPerMonth;
use Tests\SuperMetricsTestCase;

class AveragePostLengthPerMonthTest extends SuperMetricsTestCase
{
    public function testValidPosts()
    {
        $instance = new AveragePostLengthPerMonth();

        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->calculate($post);
        }

        $this->assertEquals(
            '{"Average character length of posts per month":{"June":12,"July":12.8,"September":12}}',
            $instance->getResultMessage()
        );
    }
}