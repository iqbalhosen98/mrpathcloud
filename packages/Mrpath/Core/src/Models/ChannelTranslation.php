<?php

namespace Mrpath\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Mrpath\Core\Contracts\ChannelTranslation as ChannelTranslationContract;

class ChannelTranslation extends Model implements ChannelTranslationContract
{
    protected $guarded = [];
}