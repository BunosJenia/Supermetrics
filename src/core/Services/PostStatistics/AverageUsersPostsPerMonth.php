<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

class AverageUsersPostsPerMonth extends AbstractPostsStatistics
{
    public function calculate(Post $post)
    {
        $month = $post->getPostMonth();
        $userId = $post->getUserId();

        $this->resultedDataArray[$userId][$month][] = $post->getMessageLength();
    }

    public function getResult(): array
    {
        return array_map(
            function (array $usersData) {
                return array_map(
                    function (array $monthData) {
                        return array_sum($monthData) / count($monthData);
                    },
                    $usersData
                );
            },
            $this->resultedDataArray
        );
    }

    protected function getStatisticsHeaderText(): string
    {
        return "Average number of posts per user per month";
    }
}