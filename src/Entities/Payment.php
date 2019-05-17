<?php

namespace Grechanyuk\FreeKassa\Entities;

use Grechanyuk\FreeKassa\Interfaces\PaymentInterface;

class Payment
{
    private $order_id;
    private $amount;
    private $phone;
    private $email;

    public function __construct($payment)
    {
        if ($payment instanceof PaymentInterface) {
            return $this->fromPaymentInterface($payment);

        } else {
            if (is_array($payment)) {
                return $this->fromArray($payment);
            }
        }

        throw new \InvalidArgumentException('Invalid argument in Payment construct');
    }

    private function fromPaymentInterface(PaymentInterface $payment): Payment
    {
        $this->email = $payment->PaymentInterfaceGetEmail();
        $this->amount = $payment->PaymentInterfaceGetAmount();
        $this->order_id = $payment->PaymentInterfaceGetOrderId();
        $this->phone = $payment->PaymentInterfaceGetPhone();

        return $this;
    }

    private function fromArray(array $payment)
    {
        $this->email = $payment['email'] ?? null;
        $this->amount = $payment['amount'];
        $this->order_id = $payment['order_id'];
        $this->phone = $payment['phone'] ?? null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}