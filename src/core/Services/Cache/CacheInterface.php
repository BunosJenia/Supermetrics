<?php

namespace App\Services\Cache;

/**
 * Interface CacheInterface
 *
 * Implement this interface for using cache.
 */
interface CacheInterface
{
    /**
     * Checks that token exist and it valid.
     *
     * @return bool
     */
    public function isTokenExistAndValid(): bool;

    /**
     * Return token string
     *
     * @return string
     */
    public function getToken(): string;

    /**
     * Set Token string. So we can store it and take if it valid.
     *
     * @param string $token
     */
    public function setToken(string $token);
}