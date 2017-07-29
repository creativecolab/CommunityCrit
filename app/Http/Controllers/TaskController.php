<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Source;
use App\Idea;
use App\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
//use Cornford\Googlmapper\Mapper;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class TaskController extends Controller
{
    //--------------------- SHOW METHODS ------------------------------

    /**
     * Redirects to the appropriate view according to the task
     * TODO: finish for all types of tasks
     *
     * @param $task
     * @param $type
     * @return string
     */
    private function showRedirect( $task, $type )
    {
        $allTypes = Task::TYPES;
        $evals = collect($allTypes['eval']);
        $imps = collect($allTypes['improve']);
        $subs = collect($allTypes['submit']);
        //TODO: change if we do many to many tasks <--> ideas
        $idea = $task->ideas->first();
        $view = '';
        $data = [];

        if ($evals->keys()->contains($type)) {
            $view = 'ideas.rating';
            $data['idea'] =  $idea;
            $data['ratings'] = Rating::QUALITIES;
        } else if ($imps->keys()->contains($type)) {

        } else if ($subs->keys()->contains($type)) {
            $view = 'ideas.submitIdea';
        }

        $vals = ['view' => $view, 'data' => $data];
        return $vals;
    }

    /**
     * show question
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $id )
    {
        $task = Task::find($id);

        if ($task == null) {
            abort(404);
        }
        if ($task->type == Task::TYPE_IMAGE) {
            return redirect()->action( 'TaskController@imageTest', $task->id );
        }
        $title = $task->name;
        $options = $task->options;
        $data = ['task' => $task, 'title' => $title, 'options' => $options];

//        $view = 'tasks.questions.activity';
        $redVals = collect($this->showRedirect( $task, $task->type));
        $view = $redVals['view'];
        foreach($redVals['data'] as $key=>$val) {
            $data[$key] = $val;
        }
        return view($view, $data);
    }

    /**
     * view page for connecting tasks to ideas (for dev use)
     *
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showConnect(Task $task)
    {
        $user = \Auth::user();
        if ($user->admin != 1)
            return redirect()->action( 'HomeController@index' );

        $view = 'tasks.connectTaskIdea';
        $data = ['id' => $task->id, 'ideas' => Idea::get()];

        return view($view, $data);
    }

    /**
     * view page for elaborate/build type activity
     *
     * @param $task_id
     * @param $idea_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showElaborate( $task_id, $idea_id )
    {
        $view = 'activities.elaboration';

        $idea = Idea::find($idea_id);
        $task = Task::find($task_id);

        $links = $idea->links;

        $data = ['idea' => $idea, 'link' => $links->first(), 'task' => $task];

        return view($view, $data);
    }

    /**
     * view page for overview - reset local storage TODO: put local storage methods elsewhere
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
        //refresh visited questions when seeing overview page
        \Session::forget('visited');
        \Session::put('visited', []);
//        $data = [];
        return view('overview');
    }

    public function newTask( Request $request )
    {
        $task = new Task;
        $task->name = $request->get('name');
        $task->text = $request->get('text');
        //$task->type = $request->get('type');
        if ( $task->save() ) {
            flash("Activity submitted!")->success();
        } else {
            flash('Unable to save your question. Please contact us.')->error();
        }

        return redirect()->back();
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
//        $type = $request->get( 'type' );
        $input1 = $request->get( 'input1' );
        $input2 = $request->get( 'input2' );
        $input3 = $request->get( 'input3' );

		$feedback          = new Feedback;
//		$feedback->comment = $request->get( 'comment' );
		$feedback->user_id = \Auth::id();
		$feedback->task_id = $task->id;
        $feedback->type = $request->get( 'type' );
        $feedback->comment = $feedback->constructComment($feedback->type, $input1, $input2, $input3);

		$taskName = $task->name;

		if ( $feedback->save() ) {
			flash("Feedback submitted for ${taskName}!")->success();
		} else {
			flash('Unable to save your feedback. Please contact us.')->error();
		}

		return redirect()->back();
	}

    private function nextTask( $id )
    {
        //TODO tree traversal here --------------------
//        $task = Task::where('id',$id)->first();
//
//        //get first child
//        $next = $task->immediateDescendants()->first();
//
//        //tree traversal
//        if ($next == null) {
//            $next = $task;
//            while ($next->parent_id != null) {
//                //if has siblings, and parent is not branch question, go to sibling that isnt visited
//                $siblings = $next->getSiblings();
//                if (!$siblings->isEmpty() && $next->parent()->first()->type != Task::TYPE_BRANCH_QUESTION){
//                    $available = collect($siblings->pluck('id')->all())->diff(\Session::get('visited'));
//                    if (!$available->isEmpty()) {
//                        $next = Task::findMany($available)->first();
//                        break;
//                    }
//                }
//                $next = Task::find($next->parent_id);
//            }
//        }
//
//        if ($next->parent_id == null) {
//            return null;
//        }
//        else {
//            return $next->id;
//        }
        //--------------------------------------------

        //randomized tasks from all
        //--------------------------------------------
        $next_ids = collect(Task::all()->pluck('id')->all())->diff(\Session::get('visited'));
        if (!$next_ids->isEmpty())
            $next_id = $next_ids->random();
        else $next_id = null;
        return $next_id;
    }

    public function storeResponse( Request $request, Task $task )
    {
        $keys = collect($request->except('_token'))->keys()->all();
//        $type = $request->get( 'type' );

        $responses = collect([]);

        foreach($keys as $key) {
            $feedback = new Feedback;
            $feedback->user_id = \Auth::id();
            $feedback->option = $key;
            $feedback->comment = $request->get( $key );
            $responses->push($feedback);
        }
        if( $task->feedback()->saveMany($responses->all()) ) {
            flash("Feedback submitted!");
        } else {
            flash("Unable to save your feedback. Please contact us.")->error();
        }

//        $feedback          = new Feedback;
//        $feedback->user_id = \Auth::id();
//        $feedback->task_id = $task->id;
////        $feedback->comment = $request->get( 'option' );
//        $feedback->comment = collect($keys)->implode(' | ');
//        $taskName = $task->name;
//
//        if ( $feedback->save() ) {
//            flash("Feedback submitted for ${taskName}!")->success();
//        } else {
//            flash('Unable to save your feedback. Please contact us.')->error();
//        }

//        \Session::push('visited', $task->id);

//        $next = $this->nextTask($task->id);
//
//        if ($next != null) {
//            return redirect()->action(
//                'TaskController@show', ['id' => $next]
//            );
//        }
//        else {
//            return redirect()->action(
//                'TaskController@allProjects'
//            );
//        }
        return redirect()->action(
            'TaskController@allActivities'
        );
    }

    public function skipQuestion(/**Request $request, **/Task $task)
    {
        \Session::push('visited', $task->id);

        $next = $this->nextTask($task->id);

        if ($next != null) {
            return redirect()->action(
                'TaskController@testShow', ['id' => $next]
            );
        }
        else {
            return redirect()->action(
//                'TaskController@allProjects'
                'TaskController@overview'
            );
        }
    }

    /**
     * Display single task view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function testShow( $id )
    {
        if ($id == 0) {
            $task = Task::all()->random(1)->first();
        }
        else {
            $task = Task::where('id', $id)->first();
        }

        if ($task == null) {
            abort(404);
        }

        $view = 'proto.test';

        $test = \Session::get('test');

		$title = $task->name;
        $options = $task->options;
        $data = ['task' => $task, 'title' => $title, 'options' => $options, 'test' => $test];
        if ($id == 0)
            return redirect()->action( 'TaskController@testShow', ['id' => $task->id]);
        return view($view, $data);
    }

    public function uploadImage( Request $request, Task $task )
    {
        $id = \Auth::id();
        $task_id = $task->id;

        $path = public_path() . '/images/activities/' . $id . '/' . $task_id . '/';
        $img = $request->file('photo');
        if(!\File::exists($path)) {
            \File::makeDirectory($path, 0777, true);
        }
        Image::make($img)->resize(300, 300)->save($path . 'bar.jpg');
        return redirect()->action('TaskController@allActivities');
    }

    public function imageTest($id)
    {
        $task = Task::find($id);

        $view = 'tasks.questions.image';
        $dir = \Auth::id();

        $path = public_path() . '/images/activities/' . $dir . '/' . $id . '/';
        if(\File::exists($path))
            $path = '/images/activities/' . $dir . '/' . $id . '/';
        else $path = null;
        $data = ['task' => $task, 'name' => $task->name, 'text' => $task->text, 'path' => $path, 'id' => $id];

        return view($view, $data);
    }

    public function testStoreResponse( Request $request, Task $task )
    {
        $feedback          = new Feedback;
//		$feedback->comment = $request->get( 'comment' );
        $feedback->user_id = \Auth::id();
        $feedback->task_id = $task->id;
        $feedback->type = 'custom';

        $feedback->comment = $request->get( 'option' );

        $taskName = $task->name;

        if ( $feedback->save() ) {
            flash("Feedback submitted for ${taskName}!")->success();
        } else {
            flash('Unable to save your feedback. Please contact us.')->error();
        }

        return redirect()->back();
    }

    public function allActivities()
    {
        $view = 'tasks.questions.allActivities';
        $data = ['tasks' => Task::all()];
        return view($view, $data);
    }

    public function dashboard(Request $request)
    {
        $view = 'tasks.questions.workflow';
        $data['topics'] = Topic::all();
        $data['projects'] = Project::all();

        return view($view, $data);
    }

    public function mapTest()
    {
        Mapper::map(53.381128999999990000, -1.470085000000040000);
//        Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true]);
//        Mapper::informationWindow(53.381128999999990000, -1.470085000000040000, 'Content', ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => 'Title']]);
        Mapper::map(52.381128999999990000, 0.470085000000040000)->informationWindow(53.381128999999990000, -1.470085000000040000, 'Content', ['markers' => ['animation' => 'DROP']]);

        return view('proto.map');
    }

    public function connectTaskIdea(Request $request, Task $task)
    {
        $ideas = collect($request->except('_token'))->values()->all();

        $task->ideas()->syncWithoutDetaching($ideas);
        flash('good');
        return redirect()->back();
    }

    public function newsubmit( Request $request )
    {
        $inputs = $request->input();
        $idea = new Idea;
        $idea->text = $request->get('text');
        $idea->save();
        $data = [
            'success' => true,
            'message' => 'Your AJAX processed correctly'
        ];
        return response()->json($data);
    }

    public function elaborate( Request $request, Idea $idea )
    {
        $feedback = new Feedback;
        $feedback->user_id = \Auth::id();
        $feedback->comment = $request->get( 'text' );
        $feedback->type = 'build';

        if ( $idea->feedback()->save($feedback) ) {
            flash("Comment submitted!")->success();
        } else {
            flash('Unable to save your feedback. Please contact us.')->error();
        }

        return redirect()->back();
    }

    private function taskQueue( $task_id )
    {
        \Session::push('visited', $task_id);
        \Session::get('queue');
    }

    /**
    //	 * Display a listing of the resource.
    //	 * @return \Illuminate\Http\Response
    //	 * @throws AuthorizationException
    //	 */
//	public function index()
//	{
//		$condition = \Auth::user()->condition;
//
//		// Don't allow user through if they don't have a condition (means
//		if ($condition === null) {
//			throw new AuthorizationException();
//		}
//
//		// Mapping of conditions to template names;
//		$views = [
//			User::CONDITION_GENERIC_HOLISTIC => 'tasks.generic.holistic',
//			User::CONDITION_GENERIC_MICROTASK_OPEN => 'tasks.generic.microtaskOpen',
//			User::CONDITION_GENERIC_MICROTASK_CLOSED => 'tasks.generic.microtaskClosed',
//			User::CONDITION_PERSONAL_HOLISTIC => 'tasks.personal.holistic',
//			User::CONDITION_PERSONAL_MICROTASK_OPEN => 'tasks.personal.microtaskOpen',
//			User::CONDITION_PERSONAL_MICROTASK_CLOSED => 'tasks.personal.microtaskClosed',
//		];
//
//		// Set template name based on condition
//		$view = $views[$condition];
//
//		// Decide which data to fetch
//		switch($condition) {
//			case User::CONDITION_PERSONAL_MICROTASK_CLOSED:
//				$data = ['task' => \Auth::user()->recommendedTasks->first()];
//				break;
//			case User::CONDITION_GENERIC_MICROTASK_CLOSED:
//				$data = ['task' => Task::find(1)]; // TODO: Change to assigned task later
//				break;
//			case User::CONDITION_PERSONAL_MICROTASK_OPEN:
//				$tasks = Task::allLeaves()->get();
//				$data = ['tasks' => $tasks];
//				break;
//			default:
//				// Get first root task
//				$rootTask = Task::root();
//
//				// Return tasks and root task
//				$data = ['tasks' => $rootTask->getDescendants(), 'rootTask' => $rootTask];
//		}
//
//		// Embed recommendations if needed
//		if ($condition === User::CONDITION_PERSONAL_MICROTASK_OPEN ||
//		    $condition === User::CONDITION_PERSONAL_HOLISTIC) {
//			$data['recommendations'] = \Auth::user()->recommendedTasks->pluck('id');
//		}
//
//		return view($view, $data);
//	}


    //    /**
//     * Display all facets
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function allFacets()
//    {
//        $view = 'tasks.facets.listAll';
//        $data['title'] = 'Facets';
//		$data['facets'] = Task::getFacets();
//        return view($view, $data);
//    }
//
//    public function singleFacet($slug)
//    {
//        $facet = Task::where('slug',$slug)->first();
//
//        if ($facet == null) {
//            abort(404);
//        }
//
//        $view = 'tasks.facets.singleFacet';
//
//        $data['title'] = $facet->name;
//        $data['tasks'] = $facet->quotes;
//        $data['facet'] = $facet;
//        return view($view, $data);
//    }
//
//    public function allSources()
//    {
//        $view = 'tasks.sources.listAll';
//        $data['title'] = 'Sources';
//        $data['sources'] = Task::getSources();
//        return view($view, $data);
//    }
//
//    public function singleSource($slug)
//    {
//        $source = Task::where('slug',$slug)->first();
//
//        if ($source == null) {
//            abort(404);
//        }
//
//        $view = 'tasks.sources.singleSource';
//
//        $data['title'] = $source->name;
//        $data['source'] = $source;
//        $data['quotes'] = $source->sourceHasQuotes;
////        $data['quotes'] = Task::get()->where('source_id',25);
//        return view($view, $data);
//    }
//
//    public function allProjects()
//    {
//        $view = 'tasks.questions.projects';
//        $data['title'] = 'Projects';
//        $data['projects'] = Task::getProjects();
//
//        //refresh visited questions when seeing all projects
//        \Session::forget('visited');
//        \Session::put('visited', []);
//
//        return view($view, $data);
//    }
//
//    public function quote($id)
//    {
//        $quote = Task::where('id',$id)->first();
//
//        if ($quote == null) {
//            abort(404);
//        }
//
//        $view = 'tasks.quote';
//
//        $data['title'] = $quote->name;
//        $data['quote'] = $quote;
//        return view($view, $data);
//    }
}
