<?php

namespace Mrpath\CMS\Providers;

use Mrpath\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Mrpath\CMS\Models\CmsPage::class,
        \Mrpath\CMS\Models\CmsPageTranslation::class
    ];
}