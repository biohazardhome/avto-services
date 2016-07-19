<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if ($request->is('/')) {
            view()->composer(
                'layouts.index', 'App\Http\Composers\CommentsIndexComposer'
            );
        }

        // if (!$request->is('map/*', 'map')) {
        if ($request->is('/')) {
            view()->composer(
                'layouts.index', 'App\Http\Composers\MapIndexComposer'
            );
        }

        // Using Closure based composers...
        /*view()->composer('dashboard', function ($view) {
            //
        });*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
