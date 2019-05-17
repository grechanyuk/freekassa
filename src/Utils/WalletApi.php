<?php

namespace Grechanyuk\FreeKassa\Utils;

class WalletApi extends Api
{
    protected $base_uri = 'https://www.fkwallet.ru/api_v1.php';
    private $wallet_id;
    private $api_key;

    public function __construct()
    {
        parent::__construct();

        $this->defaultParams = [
            'wallet_id' => config('freekassa.wallet_id')
        ];

        $this->wallet_id = config('freekassa.wallet_id');
        $this->api_key = config('freekassa.api_key');
    }

    public function balance()
    {
        $json = $this->post([
            'action' => 'get_balance',
            'sign' => md5($this->wallet_id . $this->api_key)
        ], 'json');
        return $json ? $json->balance : false;
    }

    public function getPaymentInfo(int $payment_id)
    {
        $json = $this->post([
            'action' => 'get_payment_status',
            'payment_id' => $payment_id,
            'sign' => md5(config($this->wallet_id . $payment_id . $this->api_key))
        ]);

        return $json ? $json->data : false;
    }

    public function checkNotificationSign(string $sign)
    {
        //TODO NotificationSign If exist
        return false;
    }
}