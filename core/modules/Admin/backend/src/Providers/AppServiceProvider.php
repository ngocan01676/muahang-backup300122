<?php
namespace Admin\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {

        \Event::listen(\Illuminate\Routing\Events\RouteMatched::class, function () {

        });
        Blade::component('backend::layout.component.button-option', 'btnOption');
        Blade::component('backend::layout.component.breadcrumb', 'breadcrumb');
        Blade::component('backend::layout.component.flash-message', 'flash_message');
        Blade::component('backend::layout.component.input-image-media', 'InputImageMedia');

        \Form::component('btn_save', 'backend::layout.form.btn-save', ['name', 'value' => null,'label'=>null, 'attributes' => []]);
    }
}
