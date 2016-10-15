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
        view()->composer(
            ['index', 'catalog.city'], 'App\Http\Composers\CommentsIndexComposer'
        );

        view()->composer(
            ['index', 'catalog.city', 'catalog.service'], 'App\Http\Composers\MapIndexComposer'
        );
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
