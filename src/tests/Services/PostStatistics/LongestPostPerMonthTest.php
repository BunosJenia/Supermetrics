<?php

declare(strict_types=1);

namespace Tests\Services\PostStatistics;

use App\Services\PostStatistics\LongestPostPerMonth;
use Tests\SuperMetricsTestCase;

/**
 * Class LongestPostPerMonthTest
 *
 * Test calculations of LongestPostPerMonth class.
 */
class LongestPostPerMonthTest extends SuperMetricsTestCase
{
    /**
     *
     */
    public function testCalculations()
    {
        $instance = new LongestPostPerMonth();
        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->combine($post);
        }

        $result = $instance->getResult();

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Longest post by character length per month":{"June":16,"July":16,"September":16}}',
            json_encode($result)
        );
    }
}