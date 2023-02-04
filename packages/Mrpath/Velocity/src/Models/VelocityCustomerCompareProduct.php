<?php

namespace Mrpath\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Product\Models\ProductFlatProxy;
use Mrpath\Customer\Models\CustomerProxy;
use Mrpath\Velocity\Contracts\VelocityCustomerCompareProduct as VelocityCustomerCompareProductContract;

class VelocityCustomerCompareProduct extends Model implements VelocityCustomerCompareProductContract
{
    protected $guarded = [];

    /**
     * The product_flat that belong to the compare product.
     */
    public function product_flat()
    {
        return $this->belongsTo(ProductFlatProxy::modelClass(), 'product_flat_id');
    }

    /**
     * The customer that belong to the compare product.
     */
    public function customer()
    {
        return $this->belongsTo(CustomerProxy::modelClass(), 'customer_id');
    }
}