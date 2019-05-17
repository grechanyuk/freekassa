<?php
Route::post(config('freekassa.notificationUrl'), 'Grechanyuk\FreeKassa\Controllers\NotificationController@notificate')->middleware('freekassa');