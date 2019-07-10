<?php
namespace App\Services\Contracts;

interface Endpoint
{
    public function get();
    public function post(string $url, array $data = []);
    public function put(array $data, int $id);
    public function delete(int $id);
}