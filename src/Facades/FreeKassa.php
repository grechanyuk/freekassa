<?php

namespace Grechanyuk\FreeKassa\Facades;

use Grechanyuk\FreeKassa\Entities\Payment;
use Illuminate\Support\Facades\Facade;

/**
 * @method static balance()
 * @method static checkOrder(int $order_id)
 * @method static newInvoice(string $email, int $amount, string $description)
 * @method static getPaymentInfo(int $payment_id)
 * @method static newPayment(Payment|array $payment, int $currency = null, string $locale = null)
 * @method static checkNotificationSign(string $sign, float $amount, int $order_id)
 */
class FreeKassa extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'freekassa';
    }
}
