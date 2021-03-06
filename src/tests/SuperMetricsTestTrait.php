<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Post;

/**
 * Trait SuperMetricsTestTrait
 *
 * Just for getting Posts objects stack for testing.
 */
trait SuperMetricsTestTrait
{
    /**
     * Method for getting stack objects for testing.
     *
     * @return Post[]
     */
    protected function getPosts(): array
    {
        $datetimeJune = new \DateTime("2020-06-11T04:39:03+00:00");
        $datetimeJule = new \DateTime("2020-07-11T04:39:03+00:00");
        $datetimeSept = new \DateTime("2020-09-11T04:39:03+00:00");

        return [
            new Post("user_id1", "UserName", "message1", $datetimeJune),
            new Post("user_id2", "UserName", "message2", $datetimeJune),
            new Post("user_id1", "UserName", "longlongmessage1", $datetimeJune),
            new Post("user_id2", "UserName", "longlongmessage2", $datetimeJune),
            new Post("user_id1", "UserName", "message1", $datetimeJule),
            new Post("user_id2", "UserName", "message2", $datetimeJule),
            new Post("user_id1", "UserName", "longlongmessage1", $datetimeJule),
            new Post("user_id2", "UserName", "longlongmessage2", $datetimeJule),
            new Post("user_id3", "UserName", "longlongmessage3", $datetimeJule),
            new Post("user_id1", "UserName", "message1", $datetimeSept),
            new Post("user_id2", "UserName", "message2", $datetimeSept),
            new Post("user_id3", "UserName", "message3", $datetimeSept),
            new Post("user_id1", "UserName", "longlongmessage1", $datetimeSept),
            new Post("user_id2", "UserName", "longlongmessage2", $datetimeSept),
            new Post("user_id3", "UserName", "longlongmessage3", $datetimeSept),
        ];
    }
}