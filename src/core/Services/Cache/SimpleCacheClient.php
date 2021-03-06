<?php

namespace App\Services\Cache;

/**
 * Class SimpleCacheClient
 *
 * Simple example of CacheInterface implementation and how we can use it.
 */
class SimpleCacheClient implements CacheInterface
{
    private const TOKEN_LIFE_TIME = 3600;

    /**
     * @return bool
     */
    public function isTokenExistAndValid(): bool
    {
        if (isset($_SESSION['token_time']) && isset($_SESSION['token']) && $_SESSION["token_created"] > time()) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $_SESSION["token"] ?? "";
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $_SESSION["token_created"] = time() + self::TOKEN_LIFE_TIME;
        $_SESSION["token"] = $token;
    }
}