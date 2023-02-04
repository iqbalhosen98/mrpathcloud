<?php

namespace Mrpath\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Product\Contracts\ProductBundleOptionTranslation as ProductBundleOptionTranslationContract;

class ProductBundleOptionTranslation extends Model implements ProductBundleOptionTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['label'];
}