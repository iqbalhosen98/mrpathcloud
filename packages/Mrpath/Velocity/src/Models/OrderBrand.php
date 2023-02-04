<?php

namespace Mrpath\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Velocity\Contracts\OrderBrand as OrderBrandContract;
use Mrpath\Attribute\Models\AttributeOptionProxy;
use Mrpath\Category\Models\CategoryProxy;

class OrderBrand extends Model implements OrderBrandContract
{
    
    protected $table = 'order_brands';

    protected $fillable = [
        'order_item_id',
        'order_id',
        'product_id',
        'brand',
    ];

    public function getBrands()
    {
        return $this->belongsTo(AttributeOptionProxy::modelClass() , 'brand');
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(CategoryProxy::modelClass(), 'product_categories','product_id');
    }
    
}