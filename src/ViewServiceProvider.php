<?php namespace Bugotech\View;

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
            $paths = $app['config']['view.paths'];
            if (is_null($paths)) {
                $paths = realpath(base_path('resources/views'));
                $app['config']->set('view.paths', $paths);
                $app['config']->set('view.compiled', realpath(storage_path('framework/views')));
            }

            return new FileViewFinder($app['files'], $paths);
        });
    }
}
