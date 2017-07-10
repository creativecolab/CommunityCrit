<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Facet;
use App\Source;
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
			case User::CONDITION_PERSONAL_MICROTASK_CLOSED:
				$data = ['task' => \Auth::user()->recommendedTasks->first()];
				break;
			case User::CONDITION_GENERIC_MICROTASK_CLOSED:
				$data = ['task' => Task::find(1)]; // TODO: Change to assigned task later
				break;
			case User::CONDITION_PERSONAL_MICROTASK_OPEN:
				$tasks = Task::allLeaves()->get();
				$data = ['tasks' => $tasks];
				break;
			default:
				// Get first root task
				$rootTask = Task::root();

				// Return tasks and root task
				$data = ['tasks' => $rootTask->getDescendants(), 'rootTask' => $rootTask];
		}

		// Embed recommendations if needed
		if ($condition === User::CONDITION_PERSONAL_MICROTASK_OPEN ||
		    $condition === User::CONDITION_PERSONAL_HOLISTIC) {
			$data['recommendations'] = \Auth::user()->recommendedTasks->pluck('id');
		}

		return view($view, $data);
	}

	/**
	 * Save feedback item for task
	 *
	 * @param FeedbackRequest $request
	 * @param Task $task
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeFeedback( FeedbackRequest $request, Task $task )
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

    /**
     * Display single task view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function show( $id )
    {
        $task = Task::where('id',$id)->first();

        if ($task == null) {
            abort(404);
        }

        $view = 'proto.test';

//        $tags = $task->tags()->where('task_id',$task->id)->pluck('parent_id');
//        $parents = Task::whereIn('id',$tags)->get();

        $facets = $task->facets()->get();

		$title = $task->name;
        $data = ['task' => $task, 'facets' => $facets, 'title' => $title];
        return view($view, $data);
    }

    /**
     * Display all facets
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allFacets()
    {
        $view = 'tasks.facets.listAll';
        $data['title'] = 'Facets';
		$data['facets'] = Task::getFacets();
        return view($view, $data);
    }

    public function singleFacet($slug)
    {
        $facet = Task::where('slug',$slug)->first();

        if ($facet == null) {
            abort(404);
        }

        $view = 'tasks.facets.singleFacet';

        $data['title'] = $facet->name;
        $data['tasks'] = $facet->quotes;
        $data['facet'] = $facet;
        return view($view, $data);
    }

    public function allSources()
    {
        $view = 'tasks.sources.listAll';
        $data['title'] = 'Sources';
        $data['sources'] = Task::getSources();
        return view($view, $data);
    }

    public function singleSource($slug)
    {
        $source = Task::where('slug',$slug)->first();

        if ($source == null) {
            abort(404);
        }

        $view = 'tasks.sources.singleSource';

        $data['title'] = $source->name;
        $data['source'] = $source;
        $data['quotes'] = $source->sourceHasQuotes;
//        $data['quotes'] = Task::get()->where('source_id',25);
        return view($view, $data);
    }

    public function quote($slug)
    {
        $quote = Task::where('slug',$slug)->first();

        if ($quote == null) {
            abort(404);
        }

        $view = 'tasks.quote';

        $data['title'] = $quote->name;
        $data['quote'] = $quote;
        return view($view, $data);
    }
}
