<?php

namespace Grechanyuk\FreeKassa\Interfaces;

interface PaymentInterface
{
    public function PaymentInterfaceGetOrderId();

    public function PaymentInterfaceGetAmount();

    public function PaymentInterfaceGetEmail();

    public function PaymentInterfaceGetPhone();
}