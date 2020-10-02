<?php


namespace App\Services\PostStatistics;



use App\Models\Post;

class ServiceLocator
{
    /** @var AbstractPostsStatistics[] */
    private array $services = [];

    public function addService(AbstractPostsStatistics $service)
    {
        $this->services[] = $service;
    }

    /**
     * @param Post[] $posts
     *
     * @return string
     */
    public function locate(array $posts): string
    {
        $resultMessage = "";

        foreach ($this->services as $service) {
            foreach ($posts as $post) {
                $service->calculate($post);
            }

            $resultMessage .= $service->getResultMessage();
        }

        return json_encode($resultMessage);
    }
}