<?php

namespace Mrpath\Notification\Models;

use Mrpath\Sales\Models\OrderProxy;
use Illuminate\Database\Eloquent\Model;
use Mrpath\Notification\Contracts\Notification as NotificationContract;

class Notification extends Model implements NotificationContract
{
    protected $fillable = [
        'type',
        'read',
        'order_id'
    ];

    /**
     * Get Order Details.
     */
    public function order()
    {
        return $this->belongsTo(OrderProxy::modelClass());
    }
}