<?php

namespace Mrpath\Marketing\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Product\Models\ProductProxy;
use Mrpath\Marketing\Contracts\Event as EventContract;

class Event extends Model implements EventContract
{
    protected $table = 'marketing_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date',
    ];
}