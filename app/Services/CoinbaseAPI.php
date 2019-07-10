<?php
namespace App\Services;

use App\Services\Contracts\Client;
use App\Services\Contracts\Endpoint;

class CoinBaseAPI implements Endpoint
{
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->init();
    }

    public function init()
    {
        $this->client->connect();
    }

    public function get()
    {
        return "";
    }

    public function post(string $url, array $data = [])
    {
        $url = $this->buildURL($url, []);
        return $this->client->request('POST', $url);
    }

    public function put(array $data, int $id)
    {
        return "";
    }

    public function delete(int $id)
    {
        return "";
    }

    private function buildURL(string $url, array $params = [])
    {
        $url = rawurlencode($url);
        $url .= '&key=' . env('PUBLIC_KEY');
        $url .= $this->processParams($params);
        return $url;
    }

    private function processParams(array $params = [])
    {
        return http_build_query($params);
    }
}