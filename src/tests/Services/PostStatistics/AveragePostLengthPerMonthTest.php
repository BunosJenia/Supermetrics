<?php

declare(strict_types=1);

namespace Tests\Services\PostStatistics;

use App\Services\PostStatistics\AveragePostLengthPerMonth;
use Tests\SuperMetricsTestCase;

/**
 * Class AveragePostLengthPerMonthTest
 *
 * Test calculations of AveragePostLengthPerMonth class.
 */
class AveragePostLengthPerMonthTest extends SuperMetricsTestCase
{
    public function testCalculations()
    {
        $instance = new AveragePostLengthPerMonth();
        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->combine($post);
        }

        $result = $instance->getResult();

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Average character length of posts per month":{"June":12,"July":12.8,"September":12}}',
            json_encode($result)
        );
    }
}