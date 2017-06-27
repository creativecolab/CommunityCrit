<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Service generic holistic by default
		$view = 'tasks.generic.holistic';

		switch(\Auth::user()->condition) {
			case User::CONDITION_GENERIC_HOLISTIC:
				$view = 'tasks.generic.holistic';
				break;
			case User::CONDITION_GENERIC_MICROTASK_OPEN:
				$view = 'tasks.generic.microtaskOpen';
				break;
			case User::CONDITION_GENERIC_MICROTASK_CLOSED:
				$view = 'tasks.generic.microtaskClosed';
				break;
			case User::CONDITION_PERSONAL_HOLISTIC:
				$view = 'tasks.personal.holistic';
				break;
			case User::CONDITION_PERSONAL_MICROTASK_OPEN:
				$view = 'tasks.personal.microtaskOpen';
				break;
			case User::CONDITION_PERSONAL_MICROTASK_CLOSED:
				$view = 'tasks.personal.microtaskClosed';
				break;
		}

		return view($view, ['tasks' => Task::all()]);
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
