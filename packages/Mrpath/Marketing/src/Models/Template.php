<?php

namespace Mrpath\Marketing\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Product\Models\ProductProxy;
use Mrpath\Marketing\Contracts\Template as TemplateContract;

class Template extends Model implements TemplateContract
{
    protected $table = 'marketing_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'content',
    ];
}