<?php
namespace App\Services\Contracts;

interface Client
{
    public function connect();
    public function request(ring $method, string $url, array $data = [], array $headers = []);
}