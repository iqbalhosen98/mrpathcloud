<?php

namespace Mrpath\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Velocity\Contracts\VelocityMetadata as VelocityMetadataContract;

class VelocityMetadata extends Model implements VelocityMetadataContract
{
    protected $table = 'velocity_meta_data';

    protected $guarded = [];

}