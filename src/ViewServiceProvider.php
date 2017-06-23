<?php namespace Bugotech\View;

use Illuminate\View\FileViewFinder;

class ViewServiceProvider extends \Illuminate\View\ViewServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->configure('view', __DIR__ . '/../config/view.php');

        parent::register();

        $this->app->alias('view', '\Illuminate\Contracts\View\Factory');
    }

    /**
     * Register the Blade engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    public function registerBladeEngine($resolver)
    {
        parent::registerBladeEngine($resolver);

        if (function_exists('i18n')) {
            blade()->directive('trans', function ($expr) {
                return "<?php echo i18n('$expr'); ?>";
            });
        }
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $this->app->configure('view', __DIR__ . '/../config/view.php');
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });
    }
}
