<?php

namespace Mrpath\Velocity\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen([
            'mrpath.admin.catalog.category.edit_form_accordian.description_images.controls.after',
            'mrpath.admin.catalog.category.create_form_accordian.description_images.controls.after',
        ], function($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate(
                    'velocity::admin.catelog.categories.category-icon'
                );
            }
        );

        Event::listen([
            'mrpath.admin.settings.slider.edit.after',
            'mrpath.admin.settings.slider.create.after',
        ], function($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate(
                    'velocity::admin.settings.sliders.velocity-slider'
                );
            }
        );

        Event::listen('mrpath.admin.layout.head', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('velocity::admin.layouts.style');
        });

        Event::listen([
            'catalog.category.create.after',
            'catalog.category.update.after',
        ], 'Mrpath\Velocity\Helpers\AdminHelper@storeCategoryIcon');

        Event::listen([
            'core.settings.slider.create.after',
            'core.settings.slider.update.after',
        ], 'Mrpath\Velocity\Helpers\AdminHelper@storeSliderDetails');

        Event::listen('checkout.order.save.after', 'Mrpath\Velocity\Helpers\Helper@topBrand');
    }
}
