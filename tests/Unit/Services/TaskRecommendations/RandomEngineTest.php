<?php

namespace Tests\Unit\Services\TaskRecommendations;

use app\Services\TaskRecommendations\RecommendationEngine;
use App\Task;
use App\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use App\Services\TaskRecommendations\RandomEngine;

class RandomEngineTest extends TestCase
{
	/* @var RecommendationEngine */
	private $engine;

	public function setUp()
	{
		parent::setUp();
		$this->engine = new RandomEngine();
	}

	public function testRecommend()
	{
		$user  = factory( User::class )->make();
		$tasks = factory( Task::class, 10 )->make();

		/* @var Collection $recommendations */
		$recommendations = $this->engine->recommend( $user, $tasks );

		$this->assertInstanceOf(Collection::class, $recommendations);
		$this->assertTrue($recommendations->isNotEmpty());
	}
}
