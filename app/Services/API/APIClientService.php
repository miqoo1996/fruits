<?php

namespace App\Services\API;

use GuzzleHttp\Client;

class APIClientService
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $uri):?array
    {
        $query = $this->client->get($uri)->getBody();

        return json_decode($query,true);
    }

    /**
     * @param string $uri
     * @param array $options
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put(string $uri, array $options = []):bool
    {
        $this->client->put($uri,$options);

        return true;
    }
}
