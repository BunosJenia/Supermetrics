<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Exceptions\APIException;
use App\Services\Cache\CacheInterface;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class TokenFetcher
 *
 * Service for getting API Token from Supermetrics.
 */
class TokenFetcher extends Client
{
    private const REGISTER_URL = "assignment/register";

    /** @var CacheInterface $cacheClient */
    private CacheInterface $cacheClient;

    /**
     * TokenFetcher constructor.
     *
     * @param GuzzleClient $client
     * @param CacheInterface $cacheClient
     */
    public function __construct(GuzzleClient $client, CacheInterface $cacheClient)
    {
        parent::__construct($client);

        $this->cacheClient = $cacheClient;
    }

    /**
     * @return string
     *
     * @throws APIException
     */
    public function getToken(): string
    {
        if ($this->cacheClient->isTokenExistAndValid()) {
            return $this->cacheClient->getToken();
        }

        $options = [
            "json" => [
                "client_id" => SUPERMETRICS_API_CLIENT_ID,
                "email"   => SUPERMETRICS_API_EMAIL,
                "name" => SUPERMETRICS_API_NAME,
            ]
        ];

        $response = $this->sendRequest(self::POST_METHOD, self::REGISTER_URL, $options);
        $token = $response["data"]["sl_token"];

        $this->cacheClient->setToken($token);

        return $token;
    }
}