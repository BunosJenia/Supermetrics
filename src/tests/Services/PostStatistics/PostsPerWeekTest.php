<?php

declare(strict_types=1);

use App\Models\Post;
use App\Services\PostStatistics\PostsPerWeek;
use Tests\SuperMetricsTestCase;

class PostsPerWeekTest extends SuperMetricsTestCase
{
    public function testValidPosts()
    {
        $instance = new PostsPerWeek();

        $posts = $this->getPosts();

        foreach ($posts as $post) {
            $instance->calculate($post);
        }

        $this->assertEquals(
            '{"Total posts split by week number":{"24":12,"28":12.8,"37":12}}',
            $instance->getResultMessage()
        );
    }
}