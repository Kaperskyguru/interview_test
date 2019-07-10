<?php
namespace App\Services;

use App\Services\APIClient;
use App\Services\CoinbaseAPI;

class CoinRepository
{
    public function __construct()
    {
        $client = new APIClient();
        $this->coinbase = new CoinbaseAPI($client);

    }

    public function getCoinBalance()
    {
        $url = "cmd=balances&format=json";
        $re = $this->coinbase->post($url);
        var_dump($re);
    }
}