<?php

declare(strict_types=1);

namespace Tests\Services\PostStatistics;

use App\Services\PostStatistics\PostsPerWeek;
use Tests\SuperMetricsTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class PostsPerWeekTest
 *
 * Test calculations of PostsPerWeek class.
 */
class PostsPerWeekTest extends TestCase
{
    use SuperMetricsTestTrait;

    public function testCalculations()
    {
        $instance = new PostsPerWeek();
        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->combine($post);
        }

        $result = $instance->getResult();

        $this->assertIsArray($result);
        $this->assertEquals(
            '{"Total posts split by week number":{"24":4,"28":5,"37":6}}',
            json_encode($result)
        );
    }
}