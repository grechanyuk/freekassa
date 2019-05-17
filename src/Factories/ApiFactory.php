<?php

namespace Grechanyuk\FreeKassa\Factories;

use Grechanyuk\FreeKassa\Utils\MerchantApi;
use Grechanyuk\FreeKassa\Utils\WalletApi;

abstract class ApiFactory
{
    protected function getApi()
    {
        if (config('freekassa.api_type')) {
            return new MerchantApi();
        } else {
            return new WalletApi();
        }
    }
}