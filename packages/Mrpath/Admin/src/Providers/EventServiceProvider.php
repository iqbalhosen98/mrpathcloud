<?php

namespace Mrpath\Admin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'user.admin.update-password' => [
            'Mrpath\Admin\Listeners\PasswordChange@sendUpdatePasswordMail'
        ],
        'checkout.order.save.after' => [
            'Mrpath\Admin\Listeners\Order@sendNewOrderMail'
        ],
        'sales.invoice.save.after' => [
            'Mrpath\Admin\Listeners\Order@sendNewInvoiceMail'
        ],
        'sales.shipment.save.after' => [
            'Mrpath\Admin\Listeners\Order@sendNewShipmentMail'
        ],
        'sales.order.cancel.after' => [
            'Mrpath\Admin\Listeners\Order@sendCancelOrderMail'
        ],
        'sales.refund.save.after' => [
            'Mrpath\Admin\Listeners\Order@refundOrder',
            'Mrpath\Admin\Listeners\Order@sendNewRefundMail',
        ],
        'sales.order.comment.create.after' => [
            'Mrpath\Admin\Listeners\Order@sendOrderCommentMail'
        ],
        'core.channel.update.after' => [
            'Mrpath\Admin\Listeners\ChannelSettingsChange@checkForMaintenaceMode'
        ],
    ];
}
