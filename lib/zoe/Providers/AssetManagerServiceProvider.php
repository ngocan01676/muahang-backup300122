<?php
namespace Zoe\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
class AssetManagerServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->singleton('asset-manager', function () {;
            return new \Zoe\AssetManager([]);
        });
    }
    public function boot(){
        Blade::directive('AssetCss', function ($expression) {
            $expression = $this->parseExpression($expression);
            return "<?php app('asset-manager')->css($expression) ?>";
        });

        Blade::directive('AssetJs', function ($expression) {
            $expression = $this->parseExpression($expression);
            return "<?php app('asset-manager')->js($expression) ?>";
        });
        Blade::directive('AssetRender', function ($expression) {
            $expression = $this->parseExpression($expression);
            return "<?php app('asset-manager')->render($expression) ?>";
        });
    }
    protected function parseExpression($expression)
    {
        if (substr($expression, 0,1) == '(') {
            $expression = substr($expression, 1, -1);
        }
        //$expression = str_replace(["'"], '', $expression);
        return $expression;
    }
}