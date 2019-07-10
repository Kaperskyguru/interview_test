<?php
namespace App\Services;

use App\Services\Contracts\Client as ClientInterface;
use GuzzleHttp\Client;

class APIClient implements ClientInterface
{
    public function __construct()
    {
        // set default params
        $this->private_key = env('PRIVATE_KEY', '');
        $this->public_key = env('PUBLIC_KEY', '');
        $this->base_url = env('BASE_URL', '');
    }
    public function connect()
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'base_uri' => $this->base_url,
                'HMAC' => $this->generate_HMAC(),
            ],

        ];

        if (is_null($options)) {
            $this->client = new Client(['base_uri' => $this->base_url]);
        } else {
            $this->client = new Client($options);
        }
        return $this;
    }

    public function request(string $method, string $url, array $data = [], array $headers = [])
    {
        strtoupper($method);
        switch ($method) {
            case 'GET':
                return $this->getRequest($url, $headers);
                break;

            case 'POST':
                return $this->postRequest($method, $url, $data, $headers);
                break;

            case 'PUT':
                return $this->putRequest($url, $data, $headers);
                break;

            case 'DELETE':
                return $this->deleteRequest($url, $data, $headers);
                break;

            default:
                throw new Exception("No valid method specify for this request");
                break;
        }
    }

    private function postRequest(string $method, string $url, $data = null, $headers = [])
    {
        return $this->client->request($method, $url, $data, $headers);
    }

    private function getRequest(string $method, string $url, $headers = [])
    {
        return $this->client->get($url, $headers);
    }

    private function putRequest(string $method, string $url, $data, $headers = [])
    {
        return $this->client->request($method, $url, $data, $headers);
    }

    private function patchRequest(string $method, string $url, $data, $headers = [])
    {
        return $this->client->request($method, $url, $data, $headers);
    }

    private function deleteRequest(string $method, string $url, $headers = [])
    {
        return $this->client->request($method, $url, $headers);
    }

    private function generate_HMAC()
    {
        return \hash_hmac('SHA512', $this->private_key, "");
    }

}