<?php

declare(strict_types=1);

namespace App\Models;

class Post
{
    private string $userId;
    private string $userName;
    private string $message;
    private \DateTime $createdTime;

    public function __construct(
        string $userId,
        string $userName,
        string $message,
        \DateTime $createdTime
    ) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->message = $message;
        $this->createdTime = $createdTime;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getCreatedTime(): \DateTime
    {
        $this->createdTime;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMessageLength(): int
    {
        return mb_strlen($this->getMessage());
    }

    public function getPostWeekNumber(): int
    {
        return (int) $this->createdTime->format('W');
    }

    public function getPostMonth(): string
    {
        return $this->createdTime->format('F');
    }
}