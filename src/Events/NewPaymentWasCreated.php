<?php

namespace Grechanyuk\FreeKassa\Events;

class NewPaymentWasCreated
{
    private $order_id;
    private $amount;
    private $telephone;
    private $email;
    private $currency;

    public function __construct(array $data)
    {
        $this->order_id = $data['o'] ?? null;
        $this->amount = $data['oa'] ?? null;
        $this->telephone = $data['phone'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->currency = $data['i'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @return float|null
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}