<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class AverageUsersPostsPerMonth
 *
 * This service calculate average number of posts per user per month.
 */
class AverageUsersPostsPerMonth extends AbstractPostsStatistics
{
    /**
     * @param Post $post
     */
    public function combine(Post $post): void
    {
        $month = $post->getPostMonth();
        $userId = $post->getUserId();

        $this->combinedData[$userId][$month][] = $post->getMessageLength();
    }

    /**
     * @return array
     */
    public function calculate(): array
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
            $this->combinedData
        );
    }

    /**
     * @return string
     */
    protected function getStatisticsHeaderText(): string
    {
        return "Average number of posts per user per month";
    }
}