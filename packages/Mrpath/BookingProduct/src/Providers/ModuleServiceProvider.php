<?php

namespace Mrpath\BookingProduct\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\BookingProduct\Models\BookingProduct::class,
        \Mrpath\BookingProduct\Models\BookingProductDefaultSlot::class,
        \Mrpath\BookingProduct\Models\BookingProductAppointmentSlot::class,
        \Mrpath\BookingProduct\Models\BookingProductEventTicket::class,
        \Mrpath\BookingProduct\Models\BookingProductEventTicketTranslation::class,
        \Mrpath\BookingProduct\Models\BookingProductRentalSlot::class,
        \Mrpath\BookingProduct\Models\BookingProductTableSlot::class,
        \Mrpath\BookingProduct\Models\Booking::class,
    ];
}