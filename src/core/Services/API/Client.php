<?php

declare(strict_types=1);

namespace App\Services\API;

use App\Exceptions\APIException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Client
 *
 * Guzzle Wrapper
 */
class Client
{
    protected const POST_METHOD = "POST";
    protected const GET_METHOD = "GET";

    /** @var GuzzleClient $client */
    protected GuzzleClient $client;

    /**
     * Client constructor.
     *
     * @param GuzzleClient $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Wrapper for Guzzle Client request.
     *
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @return array
     *
     * @throws APIException
     */
    protected function sendRequest(string $method, string $url, array $options): array
    {
        try {
            $response = $this->client->request(
                $method,
                $url,
                $options
            );

            return json_decode($response->getBody()->__toString(), true);
        } catch (GuzzleException $exception) {
            throw new APIException();
        }
    }
}