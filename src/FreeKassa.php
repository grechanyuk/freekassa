<?php

namespace Grechanyuk\FreeKassa;

use Grechanyuk\FreeKassa\Entities\Payment;
use Grechanyuk\FreeKassa\Factories\ApiFactory;
use Illuminate\Support\Arr;

class FreeKassa extends ApiFactory
{
    public function getCurrencies()
    {
        return config('freekassaCurrency.currencies');
    }

    public function balance()
    {
        return $this->getApi()->balance();
    }

    public function checkOrder(int $order_id)
    {
        return $this->getApi()->checkOrder($order_id);
    }

    public function newInvoice(string $email, float $amount, string $description)
    {
        return $this->getApi()->newInvoice($email, $amount, $description);
    }

    public function getPaymentInfo(int $payment_id)
    {
        return $this->getApi()->getPaymentInfo($payment_id);
    }

    public function newPayment($payment, int $currency = null, string $locale = null) {
        $payment = new Payment($payment);
        return $this->getApi()->newPayment($payment, $currency, $locale);
    }

    public function checkNotificationSign(string $sign, float $amount, int $order_id) :bool
    {
        return $this->getApi()->checkNotificationSign($sign, $amount, $order_id);
    }

    public function getCurrencyISO(int $currency_id): string
    {
        return Arr::where(config('freekassaCurrency.currencies'), function ($value, $key) use($currency_id) {
            return $value['ID'] === $currency_id;
        })[0] ?? null;
    }

    public function getCurrencyList(): array
    {
        return config('freekassaCurrency.currencies');
    }
}