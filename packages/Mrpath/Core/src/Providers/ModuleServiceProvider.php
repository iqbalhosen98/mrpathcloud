<?php

namespace Mrpath\Core\Providers;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\Core\Models\Channel::class,
        \Mrpath\Core\Models\CoreConfig::class,
        \Mrpath\Core\Models\Country::class,
        \Mrpath\Core\Models\CountryTranslation::class,
        \Mrpath\Core\Models\CountryState::class,
        \Mrpath\Core\Models\CountryStateTranslation::class,
        \Mrpath\Core\Models\Currency::class,
        \Mrpath\Core\Models\CurrencyExchangeRate::class,
        \Mrpath\Core\Models\Locale::class,
        \Mrpath\Core\Models\Slider::class,
        \Mrpath\Core\Models\SubscribersList::class,
    ];
}