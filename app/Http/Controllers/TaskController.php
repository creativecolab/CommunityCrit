<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\TaskHist;
use App\User;
use App\Source;
use App\Idea;
use App\Rating;
use App\Link;
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
        $link = $links[rand(0, count($links)-1)];
        // print($link);

        $data = ['idea' => $idea, 'link' => $link, 'task' => $task];

        return view($view, $data);
    }

    /**
     * view page for elaborate/build type activity
     *
     * @param $task_id
     * @param $idea_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showTask(int $task_id, int $idea_id, int $link_id ){
        $view = 'activities.elaboration';

        $task = Task::find($task_id);
        $idea = $idea_id ? Idea::all()->where('status', 1)->find($idea_id) : new Idea;
        $link = $link_id ? Link::all()->where('status', 1)->find($link_id) : new Link;

        if ($idea && $link && $task) {
            $data = ['idea' => $idea, 'link' => $link, 'task' => $task];
            if ($task->type == 100) {
                $data['qualities'] = Rating::QUALITIES;
            }

            createTaskHist($task->id, $idea->id, $link->id);

            return view($view, $data);
        } else {
            abort(404);
        }
    }

    /**
     * select task for elaborate/build type activity
     *
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTaskOfTypeCat( )
    {

        // //given $task and $type
        // $typeCat = 'eval';

        // $allTypes = Task::TYPES;
        // $type = random($allTypes[ $typeCat ]);
        // print($type;)
        
        // $task = Task::all()->filter(function($item) {
        //     return $item->type == $type;
        // })->random();

        // print($task);

        $task = Task::all()->random();

        $task_id = $task->id;

        if (($task->type / 10) != 8) {
            $idea = Idea::inRandomOrder()->first();
            $idea_id = $idea->id;
            $links = $idea->links;
            if (count($links)) {
                $link = $links[rand(0, count($links)-1)];
                $link_id = $link->id;
            } else {
                $link_id = 0;
            }
        } else {
            $idea_id = 0;
            $link_id = 0;
        }

        return redirect()->route('show-task', [$task_id, $idea_id, $link_id]);

    }

    /**
     * select task for elaborate/build type activity
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRandomTask( )
    {
        // select a random task that is meant for queuing
        $task = Task::where('type', '>', 50)->inRandomOrder()->first();
        
        // for testing a specific task type
        // $tasks = Task::all();
        // $task = $tasks->filter(function($item) {
            // return $item->type == 100;
        // })->first();

        $type = $task->type;

        $allTypes = Task::TYPES;
        $evals = collect($allTypes['eval']);
        $imps = collect($allTypes['improve']);
        $links = collect($allTypes['link']);
        $subs = collect($allTypes['submit']);
        // $idea = $task->ideas->first();
        // $view = '';
        // $data = [];

        $allFormats = Task::FORMATS;
        $rate = $allFormats['rate'];
        $text = $allFormats['text'];
        $text_link = $allFormats['text_link'];

        $ideas = Idea::all()->where('status', 1);
        // $ideas = Idea::approved();

        if ($subs->keys()->contains($type)) {
            // if a submit task, no idea needed
            $idea_id = 0;
            $link_id = 0;
            $format = 'submit-idea';
        } else {
            // if ($rate->has(102)) {
            if (in_array($type, $rate)) {
                // if a rating task, select an idea but no link
                $idea = $ideas->random();
                $link_id = 0;
                // $view = 'ideas.rating';
                // $data['idea'] =  $idea;
                // $data['ratings'] = Rating::QUALITIES;
                // return view($view, $data);
            } else if (in_array($type, $text)) {
                // if a text task, select an idea but no link
                $idea = $ideas->random();
                $link_id = 0;
                $format = 'text';
            } else if (in_array($type, $text_link)) {
                // if a text with link task, select an idea with links and a link
                $idea = $ideas->filter(function ($item) {
                   return (count($item->links));
                })->random();
                // $idea = Idea::all()->random();

                $links = $idea->links->where('status', 1);
                if (count($links)) {
                    $link = $links->shuffle()->first();
                    $link_id = $link->id;
                } else {
                    $link_id = 0;
                }
            } else {
                $idea = Idea::all()->random();
                $link_id = 0;
            }

            $idea_id = $idea->id;
        }

        return redirect()->route('show-task', [$task->id, $idea_id, $link_id]);
    }

    

    // /**
    //  * view page for elaborate/build type activity
    //  *
    //  * @param $task_id
    //  * @param $idea_id
    //  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    //  */
    // public function showRandomTask()
    // {
    //     $view = 'activities.elaboration';

    //     $idea = Idea::inRandomOrder()->get();
    //     $task = Task::inRandomOrder()->get();
    //     print($idea);
    //     print($task);
    //     // $link = Link::inRandomOrder()->get();
    //     $link = (object) ['text' => 'A tower is a tall structure, taller than it is wide, often by a significant margin. Towers are distinguished from masts by their lack of guy-wires and are therefore, along with tall buildings, self-supporting structures.', 'link_type' => 5];

    //     $data = ['idea' => $idea, 'link' => $link, 'task' => $task];
    //     // $data = ['idea' => $idea, 'link' => $links[rand(0, count($links)-1)], 'task' => $task];

    //     return view($view, $data);
    // }

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
//      $feedback->comment = $request->get( 'comment' );
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
//      $feedback->comment = $request->get( 'comment' );
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'text.required' => 'A title is required',
        ];
    }

    // /**
    //  * create a task history record
    //  *
    //  * 
    //  */
    // public function createTaskHist(Request $request)
    // {
    //     // $data = $request->all(); // This will get all the request data.

    //     // print($data); // This will dump and die

    //     $taskHist = new TaskHist;
    //     $taskHist->user_id = \Auth::id();
    //     // // $taskHist->idea_id = $request->get( 'idea' );
    //     // // $taskHist->task_id = $request->get( 'task' );
    //     // // $taskHist->link_id = $request->get( 'link' );
    //     $taskHist->save();
    // }

    /**
     * create a new idea
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trackSkip(Request $request)
    {
        $hist = updateTaskHist($request, 5);

        return redirect()->route('do');
    }

    /**
     * create a new idea
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitIdea(Request $request)
    {
        $exit = $request->get( 'exit' );

        if ($exit == 'Submit') {
            $this->validate($request, [
                'name' => 'max:255|string',
                'text' => 'required|string',
            ]);
        }

        $idea = new Idea;
        $idea->name = $request->get('name');
        $idea->text = $request->get('text');
        $idea->user_id = \Auth::id();

        if ($exit == 'Submit') {
            if ($idea->save() ) {
                flash("Your idea was submitted! You may do another activity or exit below.")->success();
            } else {
                flash('Unable to save your feedback. Please contact us.')->error();
            }

            $hist = updateTaskHist($request, 1);

            return redirect()->route('do');
        }
        else {
            if ($idea->text) {
                if ($idea->save() ) {
                    flash("Your idea was submitted!")->success();
                } else {
                    flash('Unable to save your feedback. Please contact us.')->error();
                }

                $hist = updateTaskHist($request, 2);
            } else {
                $hist = updateTaskHist($request, 3);
            }

            return redirect()->route('exit');
        }
    }

    /**
     * create a new feedback
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitText( Request $request) //Idea $idea, int $task)
    {
        $exit = $request->get( 'exit' );

        if ($exit == 'Submit') {
            $this->validate($request, [
                'text' => 'required|string',
            ]);
        }

        $feedback = new Feedback;
        $feedback->user_id = \Auth::id();
        $feedback->comment = $request->get( 'text' );
        $feedback->idea_id = $request->get( 'idea' );
        $feedback->task_id = $request->get( 'task' );
        $feedback->link_id = $request->get( 'link' );

        if ($exit == 'Submit') {
            if ( $feedback->save() ) {
                flash("Your contribution was submitted! You may do another activity or exit below.")->success();
            } else {
                flash('Unable to save your feedback. Please contact us.')->error();
            }

            $hist = updateTaskHist($request, 1);

            return redirect()->route('do');
        }
        else {
            if ($feedback->comment) {
                if ( $feedback->save() ) {
                    flash("Your contribution was submitted!")->success();
                } else {
                    flash('Unable to save your feedback. Please contact us.')->error();
                }

                $hist = updateTaskHist($request, 2);
            } else {
                $hist = updateTaskHist($request, 3);
            }

            return redirect()->route('exit');
        }
    }

    /**
     * create a new link
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitLink(Request $request)
    {
        $exit = $request->get( 'exit' );

        if ($exit == 'Submit') {
            $this->validate($request, [
                // 'name' => 'required|string',
                'text' => 'required|string',
                'text2' => 'string'
            ]);
        }

        $link = new Link;
        $link->user_id = \Auth::id();
        $link->text = $request->get('text');
        if ($request->get('text2')) {
            $link->text2 = $request->get('text2');
        }
        $link->idea_id = $request->get( 'idea' );
        $task = Task::find($request->get( 'task' ));
        $link->task_id = $task->id;
        $link->link_type = $task->type % 10;

        if ($exit == 'Submit') {
            if ($link->save() ) {
                flash("Your idea was submitted! You may do another activity or exit below.")->success();
            } else {
                flash('Unable to save your feedback. Please contact us.')->error();
            }

            $hist = updateTaskHist($request, 1);

            return redirect()->route('do');
        }
        else {
            if ($link->text) {
                if ($link->save() ) {
                    flash("Your idea was submitted!")->success();
                } else {
                    flash('Unable to save your feedback. Please contact us.')->error();
                }

                $hist = updateTaskHist($request, 2);
            } else {
                $hist = updateTaskHist($request, 3);
            }

            return redirect()->route('exit');
        }
    }

    /**
     * create new rating(s)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitRatings( Request $request) //Idea $idea, int $task)
    {
        $exit = $request->get( 'exit' );

        $qualities = Rating::QUALITIES;

        if ($exit == 'Submit') {
            foreach($qualities as $quality) {
                $this->validate($request, [
                    $quality => 'required',
                ]);
            }
        }

        $ratings = collect([]);
        foreach($qualities as $key=>$quality) {
            $rating = new Rating;
            $rating->user_id = \Auth::id();
            $rating->type = $key;
            $rating->rating = $request->get( $quality );
            if ($rating->rating != null)
                $ratings->push($rating);
        }

        $idea_id = $request->get( 'idea' );
        $idea = Idea::find($idea_id);

        if ($exit == 'Submit') {
            if ( $idea->ratings()->saveMany($ratings->all()) ) {
                flash("Ratings submitted!");
            } else {
                flash("Unable to save your ratings. Please contact us.")->error();
            }

            $hist = updateTaskHist($request, 1);

            return redirect()->route('do');
        }
        else {
            if ( $idea->ratings()->saveMany($ratings->all()) ) {
                flash("Ratings submitted!");
            } else {
                flash("Unable to save your ratings. Please contact us.")->error();
            }

            $hist = updateTaskHist($request, 4);

            return redirect()->route('exit');
        }
    }

    // /**
    //  * create task_history and redirect to correct submit function
    //  *
    //  * @param Request $request
    //  * @return \Illuminate\Http\Request
    //  */
    // public function submitTask(Request $request)
    // {
    //     $task = Task::find($request->get( 'task' ));

    //     if (intval($task->type / 10) == 8) {
    //         return redirect()->action( 'TaskController@submitIdea', $request );
    //     } else if (intval($task->type / 10) == 7) {
    //         return redirect()->action( 'TaskController@submitLink', $request );
    //     } else if ($task->type == 100) {
    //         return redirect()->action( 'TaskController@submitRating', $request );
    //     } else {
    //         return redirect()->action( 'TaskController@submitText', $request );
    //     }
    // }

    private function taskQueue( $task_id )
    {
        \Session::push('visited', $task_id);
        \Session::get('queue');
    }

    /**
    //   * Display a listing of the resource.
    //   * @return \Illuminate\Http\Response
    //   * @throws AuthorizationException
    //   */
//  public function index()
//  {
//      $condition = \Auth::user()->condition;
//
//      // Don't allow user through if they don't have a condition (means
//      if ($condition === null) {
//          throw new AuthorizationException();
//      }
//
//      // Mapping of conditions to template names;
//      $views = [
//          User::CONDITION_GENERIC_HOLISTIC => 'tasks.generic.holistic',
//          User::CONDITION_GENERIC_MICROTASK_OPEN => 'tasks.generic.microtaskOpen',
//          User::CONDITION_GENERIC_MICROTASK_CLOSED => 'tasks.generic.microtaskClosed',
//          User::CONDITION_PERSONAL_HOLISTIC => 'tasks.personal.holistic',
//          User::CONDITION_PERSONAL_MICROTASK_OPEN => 'tasks.personal.microtaskOpen',
//          User::CONDITION_PERSONAL_MICROTASK_CLOSED => 'tasks.personal.microtaskClosed',
//      ];
//
//      // Set template name based on condition
//      $view = $views[$condition];
//
//      // Decide which data to fetch
//      switch($condition) {
//          case User::CONDITION_PERSONAL_MICROTASK_CLOSED:
//              $data = ['task' => \Auth::user()->recommendedTasks->first()];
//              break;
//          case User::CONDITION_GENERIC_MICROTASK_CLOSED:
//              $data = ['task' => Task::find(1)]; // TODO: Change to assigned task later
//              break;
//          case User::CONDITION_PERSONAL_MICROTASK_OPEN:
//              $tasks = Task::allLeaves()->get();
//              $data = ['tasks' => $tasks];
//              break;
//          default:
//              // Get first root task
//              $rootTask = Task::root();
//
//              // Return tasks and root task
//              $data = ['tasks' => $rootTask->getDescendants(), 'rootTask' => $rootTask];
//      }
//
//      // Embed recommendations if needed
//      if ($condition === User::CONDITION_PERSONAL_MICROTASK_OPEN ||
//          $condition === User::CONDITION_PERSONAL_HOLISTIC) {
//          $data['recommendations'] = \Auth::user()->recommendedTasks->pluck('id');
//      }
//
//      return view($view, $data);
//  }


    //    /**
//     * Display all facets
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function allFacets()
//    {
//        $view = 'tasks.facets.listAll';
//        $data['title'] = 'Facets';
//      $data['facets'] = Task::getFacets();
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
