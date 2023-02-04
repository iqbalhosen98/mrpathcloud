<?php

namespace Mrpath\BookingProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\BookingProduct\Contracts\BookingProductTableSlot as BookingProductTableSlotContract;

class BookingProductTableSlot extends Model implements BookingProductTableSlotContract
{
    public $timestamps = false;
    
    protected $casts = ['slots' => 'array'];

    protected $fillable = [
        'price_type',
        'guest_limit',
        'duration',
        'break_time',
        'prevent_scheduling_before',
        'same_slot_all_days',
        'slots',
        'booking_product_id',
    ];
}