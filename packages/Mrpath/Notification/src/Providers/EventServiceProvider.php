<?php

namespace Mrpath\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('checkout.order.save.after', 'Mrpath\Notification\Listeners\Order@createOrder');

        Event::listen('sales.order.update-status.after', 'Mrpath\Notification\Listeners\Order@updateOrder');
    }
}
