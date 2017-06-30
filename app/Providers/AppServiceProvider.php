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
		if ( $this->app->environment() !== 'production' ) {
			$this->app->register( \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class );
			$this->app->register( \Barryvdh\Debugbar\ServiceProvider::class );

			// Register Debugbar facade
			$loader = AliasLoader::getInstance();
			$loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
		}
	}
}
