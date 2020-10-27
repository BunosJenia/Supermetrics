<?php

namespace App\Services\Cache;

interface CacheInterface
{
    public function isTokenExistAndValid(): bool;
    public function getToken(): ?string;
    public function setToken(string $token);
}