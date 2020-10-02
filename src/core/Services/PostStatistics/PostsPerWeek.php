<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

class PostsPerWeek extends AbstractPostsStatistics
{
    public function calculate(Post $post)
    {
        $weekNumber = $post->getPostWeekNumber();

        $this->resultedDataArray[$weekNumber][] = $post->getMessageLength();
    }

    public function getResult(): array
    {
        return array_map(
            function (array $data) {
                return array_sum($data) / count($data);
            },
            $this->resultedDataArray
        );
    }

    protected function getStatisticsHeaderText(): string
    {
        return "Total posts split by week number";
    }
}