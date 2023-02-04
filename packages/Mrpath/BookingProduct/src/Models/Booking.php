<?php

namespace Mrpath\BookingProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\BookingProduct\Contracts\Booking as BookingContract;
use Mrpath\Sales\Models\OrderProxy;
use Mrpath\Sales\Models\OrderItemProxy;

class Booking extends Model implements BookingContract
{
    public $timestamps = false;

    protected $fillable = [
        'qty',
        'from',
        'to',
        'order_item_id',
        'booking_product_event_ticket_id',
        'product_id',
        'order_id',
    ];

    /**
     * Get the order record associated with the order item.
     */
    public function order()
    {
        return $this->belongsTo(OrderProxy::modelClass());
    }

    /**
     * Get the child item record associated with the order item.
     */
    public function order_item()
    {
        return $this->hasOne(OrderItemProxy::modelClass());
    }
}