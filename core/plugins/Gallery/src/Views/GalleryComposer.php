<?php
namespace PluginGallery\Views;
use Illuminate\View\View;
class GalleryComposer
{
    public function __construct()
    {

    }
    public function compose(View $view)
    {
        $view->with('Gallery', $view->getFactory()->make('pluginGallery::composer.GalleryComposer',[]));
    }
}