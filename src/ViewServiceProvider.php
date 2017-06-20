<?php namespace Bugotech\View;

use Illuminate\Support\Arr;
use Illuminate\View\FileViewFinder;

class ViewServiceProvider extends \Illuminate\View\ViewServiceProvider
{
    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = $this->preparePaths();

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Preparar pastas e retornar a lista de paths.
     * @return array
     */
    protected function preparePaths()
    {
        $info = $this->app['files']->getRequire(__DIR__ . '/../config/view.php');

        $paths = $this->app['config']['view.paths'];
        if (is_null($paths)) {
            $paths = Arr::get($info, 'paths', []);
            $this->app['config']->set('view.paths', $paths);
        }

        $compiled = $this->app['config']['view.compiled'];
        if (is_null($compiled)) {
            $compiled = Arr::get($info, 'compiled', []);
            $this->app['config']->set('view.compiled', $compiled);
        }

        return $paths;
    }
}
