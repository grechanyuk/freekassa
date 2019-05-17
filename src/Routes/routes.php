<?php
Route::get(config('freekassa.notificationUrl'), 'Grechanyuk\FreeKassa\Controllers\NotificationController@notificate')->middleware('freekassa');