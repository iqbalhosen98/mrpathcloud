<?php

namespace Mrpath\BookingProduct\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\BookingProduct\Contracts\BookingProductEventTicketTranslation as BookingProductEventTicketTranslationContract;

class BookingProductEventTicketTranslation extends Model implements BookingProductEventTicketTranslationContract
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
    ];
}