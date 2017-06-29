<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\CreateFeedbackRequest;
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

				$data = ['tasks' => $rootTask->subtasks, 'rootTask' => $rootTask];
		}

		return view($view, $data);
	}

	/**
	 * Save feedback item for task
	 *
	 * @param CreateFeedbackRequest $request
	 * @param Task $task
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeFeedback( CreateFeedbackRequest $request, Task $task )
	{
		$feedback          = new Feedback;
		$feedback->comment = $request->get( 'comment' );
		$feedback->user_id = \Auth::id();
		$feedback->task_id = $task->id;

		$taskName = $task->name;

		if ( $feedback->save() ) {
			flash("Feedback submitted for ${taskName}!")->success();
		} else {
			flash('Unable to save your feedback. Please contact us.')->error();
		}

		return redirect()->back();
	}
}
