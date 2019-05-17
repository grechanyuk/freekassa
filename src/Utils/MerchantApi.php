<?php

namespace Grechanyuk\FreeKassa\Utils;

use Grechanyuk\FreeKassa\Entities\Payment;
use Grechanyuk\FreeKassa\Events\NewPaymentWasCreated;
use Illuminate\Support\Facades\App;

class MerchantApi extends Api
{
    public function __construct()
    {
        parent::__construct();

        $this->defaultParams = [
            'merchant_id' => config('freekassa.merchant_id'),
            's' => md5(config('freekassa.merchant_id') . config('freekassa.secret_2'))
        ];
    }

    public function balance()
    {
        $xml = $this->get(['action' => 'get_balance']);

        return $xml ? floatval(strip_tags($xml->balance)) : false;
    }

    public function checkOrder(int $order_id)
    {
        $xml = $this->get(['action' => 'check_order_status', 'order_id' => $order_id]);

        return $xml;
    }

    public function newInvoice(string $email, float $amount, string $description)
    {
        $xml = $this->get(['email' => $email, 'amount' => $amount, 'desc' => $description, 'action' => 'payment']);

        return $xml ? true : false;
    }

    public function newPayment(Payment $payment, int $currency = null, string $locale = null)
    {
        if (!$locale) {
            $locale = App::getLocale();
        }

        $params = [
            'm' => config('freekassa.merchant_id'),
            'i' => $currency,
            'lang' => $locale
        ];

        $params = array_merge($params, [
            'o' => $payment->getOrderId(),
            'oa' => $payment->getAmount(),
            's' => md5(config('freekassa.merchant_id') . ':' . $payment->getAmount() . ':' . config('freekassa.secret') . ':' . $payment->getOrderId()),
            'phone' => $payment->getPhone(),
            'em' => $payment->getEmail()
        ]);

        event(new NewPaymentWasCreated($params));

        $url = 'https://www.free-kassa.ru/merchant/cash.php?';
        $url .= http_build_query($params);

        return $url;
    }

    public function checkNotificationSign(string $sign, float $amount, int $order_id)
    {
        return $sign === md5(config('freekassa.merchant_id').':'.$amount.':'.config('freekassa.secret_2').':'.$order_id);
    }
}