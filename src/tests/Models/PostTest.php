<?php

declare(strict_types=1);

use Tests\SuperMetricsTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class PostTest
 */
class PostTest extends TestCase
{
    use SuperMetricsTestTrait;

    /**
     * Test main getters(which use for calculations) from Post object.
     */
    public function test()
    {
        $instance = $this->getPosts()[0];

        $this->assertEquals('message1', $instance->getMessage());
        $this->assertEquals('user_id1', $instance->getUserId());
        $this->assertEquals('24', $instance->getPostWeekNumber());
        $this->assertEquals('June', $instance->getPostMonth());
        $this->assertEquals('8', $instance->getMessageLength());
    }
}