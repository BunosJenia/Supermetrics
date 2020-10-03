<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Exceptions\APIException;

/**
 * Class TokenFetcher
 *
 * Service for getting API Token from Supermetrics.
 */
class TokenFetcher extends Client
{
    private const REGISTER_URL = "assignment/register";
    private const TOKEN_LIFE_TIME = 3600;

    /**
     * @return string
     *
     * @throws APIException
     */
    public function getToken(): string
    {
        if (isset($_SESSION['token_time']) && isset($_SESSION['token']) && $_SESSION["token_created"] > time()) {
            return $_SESSION["token"];
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

        $_SESSION["token_created"] = time() + self::TOKEN_LIFE_TIME;
        $_SESSION["token"] = $token;

        return $token;
    }
}