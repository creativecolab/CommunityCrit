<?php namespace App\Providers;
    
use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        // View::composer('app', 'App\Http\ViewComposers\AppComposer');

        // Using Closure based composers...
        // View::composer('dashboard', function($view)
        // {

        // });

        // View::composer('*', function($view)
        // {
        //     //
        // });

        view()->composer(
            'layouts.app',
            'App\Http\ViewComposers\MyContributionsComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}