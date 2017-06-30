<?php

namespace App\Providers;

use App\Services\TaskRecommendations\RecommendationEngine;
use App\Services\TaskRecommendations\RandomEngine;
use App\Services\TaskRecommendations\RecommendationService;
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
    	$this->app->bind(
    	    RecommendationEngine::class,
	        RandomEngine::class
	    );

        $this->app->singleton(RecommendationService::class, function($app) {
        	$engine = $app->make(RecommendationEngine::class);
        	return new RecommendationService($engine);
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
    public function provides()
    {
    	return [RecommendationEngine::class, RecommendationService::class];
    }
}
