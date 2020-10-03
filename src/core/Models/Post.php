<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class Post
 */
class Post
{
    /** @var string $userId */
    private string $userId;

    /** @var string $userName */
    private string $userName;

    /** @var string $message */
    private string $message;

    /** @var \DateTime $createdTime */
    private \DateTime $createdTime;

    /**
     * Post constructor.
     *
     * @param string $userId
     * @param string $userName
     * @param string $message
     * @param \DateTime $createdTime
     */
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

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime(): \DateTime
    {
        $this->createdTime;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getMessageLength(): int
    {
        return mb_strlen($this->getMessage());
    }

    /**
     * Return Posts week number.
     *
     * @return int
     */
    public function getPostWeekNumber(): int
    {
        return (int) $this->createdTime->format('W');
    }

    /**
     * Return Posts Month name.
     *
     * @return string
     */
    public function getPostMonth(): string
    {
        return $this->createdTime->format('F');
    }
}