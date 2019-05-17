<?php


namespace Grechanyuk\FreeKassa\Entities;


use Illuminate\Support\Arr;

class Notification
{
    private $amount;
    private $intId;
    private $order_id;
    private $email;
    private $telephone;
    private $currency;
    private $us_keys;

    public function __construct(array $data)
    {
        $this->amount = $data['AMOUNT'];
        $this->intId = $data['intid'];
        $this->order_id = $data['MERCHANT_ORDER_ID'];
        $this->email = $data['P_EMAIL'];
        $this->telephone = $data['P_PHONE'];
        $this->currency = $data['CUR_ID'];
        $this->us_keys = Arr::where($data, function ($value, $key) {
            return strpos($key, 'us_') === 0;
        });
    }

    /**
     * @return mixed
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getIntId()
    {
        return $this->intId;
    }

    /**
     * @return mixed
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function getUsKeys(): array
    {
        return $this->us_keys;
    }
}