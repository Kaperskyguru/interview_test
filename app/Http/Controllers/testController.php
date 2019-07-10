<?php

namespace App\Http\Controllers;

use App\Services\CoinRepository;

class testController extends Controller
{
    public function index()
    {
        $coin = new CoinRepository;
        $coin->getCoinBalance();
    }
}