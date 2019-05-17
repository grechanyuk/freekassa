<?php


namespace Grechanyuk\FreeKassa\Events;


use Grechanyuk\FreeKassa\Entities\Notification;

class SuccessNotificationWasTaked
{
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return Notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }
}