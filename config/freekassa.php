<?php

return [
    'api_type' => 1, //1 - merchant's api, 0 - wallet's api

    'notificationUrl' => 'api/freekassa/notificate',
    /**
     * For Merchant
     */
    'merchant_id' => '',
    'secret' => '',
    'secret_2' => '',

    /**
     * For Wallets
     */
    'wallet_id' => '',
    'api_key' => '',

    'checkByIPs' => true,

    'allowedIPs' => [
        '136.243.38.147',
        '136.243.38.149',
        '136.243.38.150',
        '136.243.38.151',
        '136.243.38.189',
        '88.198.88.98',
        '136.243.38.108'
    ]
];