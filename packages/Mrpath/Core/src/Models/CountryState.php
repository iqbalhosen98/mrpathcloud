<?php

namespace Mrpath\Core\Models;

use Mrpath\Core\Eloquent\TranslatableModel;
use Mrpath\Core\Contracts\CountryState as CountryStateContract;

class CountryState extends TranslatableModel implements CountryStateContract
{
    public $timestamps = false;

    public $translatedAttributes = ['default_name'];

    protected $with = ['translations'];

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['default_name'] = $this->default_name;

        return $array;
    }
}