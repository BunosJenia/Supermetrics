<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

abstract class AbstractPostsStatistics
{
    protected array $resultedDataArray = [];

    abstract public function calculate(Post $post);
    abstract protected function getResult(): array;
    abstract protected function getStatisticsHeaderText(): string;

    public function getResultMessage(): string
    {
        $returnArray = [
            $this->getStatisticsHeaderText() => $this->getResult(),
        ];

        return json_encode($returnArray);
    }
}