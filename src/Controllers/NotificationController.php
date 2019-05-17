<?php


namespace Grechanyuk\FreeKassa\Controllers;

use App\Http\Controllers\Controller;
use Grechanyuk\FreeKassa\Entities\Notification;
use Grechanyuk\FreeKassa\Events\SuccessNotificationWasTaked;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificate(Request $request)
    {
        $data = new Notification($request->all());

        event(new SuccessNotificationWasTaked($data));

        die('YES');
    }
}