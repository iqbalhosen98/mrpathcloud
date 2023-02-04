<?php

namespace Mrpath\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Attribute\Contracts\AttributeTranslation as AttributeTranslationContract;

class AttributeTranslation extends Model implements AttributeTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name'];
}