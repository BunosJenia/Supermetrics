<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

class AveragePostLengthPerMonth extends AbstractPostsStatistics
{
    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();

        $this->resultedDataArray[$month][] = $post->getMessageLength();
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
        return "Average character length of posts per month";
    }
}