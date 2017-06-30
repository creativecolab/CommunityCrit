<?php

namespace App\Providers;

use App\Services\TaskRecommendations\RecommendationEngine;
use App\Services\TaskRecommendations\RandomEngine;
use Illuminate\Support\ServiceProvider;

class TaskRecommendationsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RecommendationEngine::class, function () {
        	return new RandomEngine();
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
    public function provides()
    {
    	return [RecommendationEngine::class];
    }
}
