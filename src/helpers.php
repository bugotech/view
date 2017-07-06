<?php

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app('Illuminate\Contracts\View\Factory');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (! function_exists('blade')) {
    /**
     * Blade.
     * @return Illuminate\View\Compilers\BladeCompiler
     */
    function blade()
    {
        $blade = app('blade.compiler');

        return $blade;
    }
}