<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

class LongestPostPerMonth extends AbstractPostsStatistics
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
                return max($data);
            },
            $this->resultedDataArray
        );
    }

    protected function getStatisticsHeaderText(): string
    {
        return "Longest post by character length per month";
    }
}