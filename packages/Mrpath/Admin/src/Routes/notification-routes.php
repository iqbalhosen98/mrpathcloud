<?php

use Illuminate\Support\Facades\Route;
use Mrpath\Admin\Http\Controllers\Controller;
use Mrpath\User\Http\Controllers\ForgetPasswordController;
use Mrpath\User\Http\Controllers\ResetPasswordController;
use Mrpath\User\Http\Controllers\SessionController;

/**
 * Auth routes.
 */
Route::group(['middleware' => ['web', 'admin_locale'], 'prefix' => config('app.admin_url')], function () {
    // notification
    Route::get('notifications', 'Mrpath\Notification\Http\Controllers\Admin\NotificationController@index')->defaults('_config', [
        'view' => 'admin::notifications.index',
    ])->name('admin.notification.index');

    // get notification
    Route::get('get-notifications', 'Mrpath\Notification\Http\Controllers\Admin\NotificationController@getNotifications')
        ->name('admin.notification.get-notification');

    //view order  
    Route::get('viewed-notifications/{orderId}', 'Mrpath\Notification\Http\Controllers\Admin\NotificationController@viewedNotifications')
        ->name('admin.notification.viewed-notification');

    // read all notification
    Route::post('read-all-notifications', 'Mrpath\Notification\Http\Controllers\Admin\NotificationController@readAllNotifications')
        ->name('admin.notification.read-all');
});
