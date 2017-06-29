<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 * @throws AuthorizationException
	 */
	public function index()
	{
		$condition = \Auth::user()->condition;

		// Don't allow user through if they don't have a condition (means
		if ($condition === null) {
			throw new AuthorizationException();
		}

		// Mapping of conditions to template names;
		$views = [
			User::CONDITION_GENERIC_HOLISTIC => 'tasks.generic.holistic',
			User::CONDITION_GENERIC_MICROTASK_OPEN => 'tasks.generic.microtaskOpen',
			User::CONDITION_GENERIC_MICROTASK_CLOSED => 'tasks.generic.microtaskClosed',
			User::CONDITION_PERSONAL_HOLISTIC => 'tasks.personal.holistic',
			User::CONDITION_PERSONAL_MICROTASK_OPEN => 'tasks.personal.microtaskOpen',
			User::CONDITION_PERSONAL_MICROTASK_CLOSED => 'tasks.personal.microtaskClosed',
		];

		// Set template name based on condition
		$view = $views[$condition];

		// Decide which data to fetch
		switch($condition) {
			case User::CONDITION_GENERIC_MICROTASK_CLOSED:
			case User::CONDITION_PERSONAL_MICROTASK_CLOSED:
				$data = ['task' => Task::find(1)]; // TODO: Change to assigned task later
				break;
			case User::CONDITION_GENERIC_HOLISTIC:
			case User::CONDITION_GENERIC_MICROTASK_OPEN:
			case User::CONDITION_PERSONAL_MICROTASK_OPEN:
			case User::CONDITION_PERSONAL_HOLISTIC:
			default:
				// Get first root task
				$rootTask = Task::root()->with('subtasks')->first();

				$data = ['tasks' => $rootTask->subtasks];
		}

		return view($view, $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request )
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Task $task
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Task $task )
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Task $task
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( Task $task )
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Task $task
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, Task $task )
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Task $task
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Task $task )
	{
		//
	}
}
