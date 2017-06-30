<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ( array_has( [ 'production', 'staging' ], $this->app->environment() ) ) {
			$this->app->register( '\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class' );
			$this->app->register( '\Barryvdh\Debugbar\ServiceProvider' );

			// Register Debugbar facade
			$loader = AliasLoader::getInstance();
			$loader->alias( 'Debugbar', '\Barryvdh\Debugbar\Facade' );
		}
	}
}
