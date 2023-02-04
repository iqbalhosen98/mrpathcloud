<?php

namespace Mrpath\Sales\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Sales\Models\Order::class,
        \Mrpath\Sales\Models\OrderItem::class,
        \Mrpath\Sales\Models\DownloadableLinkPurchased::class,
        \Mrpath\Sales\Models\OrderAddress::class,
        \Mrpath\Sales\Models\OrderPayment::class,
        \Mrpath\Sales\Models\OrderComment::class,
        \Mrpath\Sales\Models\Invoice::class,
        \Mrpath\Sales\Models\InvoiceItem::class,
        \Mrpath\Sales\Models\Shipment::class,
        \Mrpath\Sales\Models\ShipmentItem::class,
        \Mrpath\Sales\Models\Refund::class,
        \Mrpath\Sales\Models\RefundItem::class,
        \Mrpath\Sales\Models\OrderTransaction::class,
    ];
}