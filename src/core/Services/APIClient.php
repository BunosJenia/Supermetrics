<?php

declare(strict_types=1);

namespace App\Services;


class APIClient
{
    private const REGISTER_URL = "assignment/register";
    private const TOKEN_LIFE_TIME = 3600;

    protected function sendRequest(string $url, array $postData = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($postData)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    protected function getAPIToken(): string
    {
        // TODO
        if (isset($_SESSION['token_time']) && $_SESSION["token_created"] < time()) {
            return $_SESSION["token"];
        }

        $url = SUPERMETRICS_BASE_URL . self::REGISTER_URL;
        $post = [
            "client_id" => SUPERMETRICS_API_CLIENT_ID,
            "email"   => SUPERMETRICS_API_EMAIL,
            "name" => SUPERMETRICS_API_NAME,
        ];
        $start = microtime(true);

        var_dump($start);
        $responseObj = $this->sendRequest($url, $post);
        var_dump(microtime(true) - $start);

        $token = $responseObj["data"]["sl_token"];

        $_SESSION["token_created"] = time();
        $_SESSION["token"] = $token;

        return $token;
    }
}