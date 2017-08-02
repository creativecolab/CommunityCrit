<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Idea;
use App\Link;
use App\Comment;
use App\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Validator;

class LinkController extends Controller
{
    /**
     * Table of Contents:
     * -private functions
     * -show functions
     * -post functions
     */


    //------------ private functions -----------------



    //---------------- show functions ----------------

    /**
     * view page to show all ideas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $view = 'ideas.all';
        $data = [];

        $ideas = Idea::get();
        $data['ideas'] = $ideas;

        return view($view, $data);
    }

    // /**
    //  * view page to show a single idea
    //  *
    //  * @param $id
    //  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    //  */
    // public function show($id)
    // {
    //     $idea = Idea::find($id);
    //     $view = 'ideas.single';
    //     $data = [];

    //     $data['idea'] = $idea;
    //     // $data['ratings'] = $this->avgRatings($idea);
    //     // $data['rating_keys'] = $data['ratings']->keys()->all();
    //     $data['links'] = $idea->links->sortBy('link_type');
    //     $data['feedbacks'] = $idea->feedback->sortByDesc('created_at');

    //     return view($view, $data);
    // }

    // *
    //  * view page to submit a new link
    //  * TODO: allow submission of link to either allow new idea or existing idea
    //  *
    //  * @param $id
    //  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     
    // public function showSubmitLink($id)
    // {
    //     $idea = Idea::find($id);
    //     $view = 'ideas.submitLink';
    //     $data = ['idea' => $idea];

    //     return view($view, $data);
    // }

    /**
     * view page to submit a new link
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubmitLink()
    {
        

        // $submitIdea = Task::where('type', '=', 80)->first();

        // return redirect()->action(
        //     'TaskController@showTask', [$submitIdea->id, 0, 0]
        // );
    }

    //------------------ post methods ------------------------

    /**
     * create a new idea
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
            ]);
        }

        $link = new Link;
        $link->user_id = \Auth::id();
        $link->text = $request->get('text');
        $link->idea_id = $request->get( 'idea' );
        $task = Task::find($request->get( 'task' ));
        $link->link_type = $task->type % 10;

        if ($exit == 'Submit') {
            if ($link->save() ) {
                flash("Your idea was submitted! You may do another activity or exit below.")->success();
            } else {
                flash('Unable to save your feedback. Please contact us.')->error();
            }

            return redirect()->route('do');
        }
        else {
            if ($link->text) {
                if ($link->save() ) {
                    flash("Your idea was submitted!")->success();
                } else {
                    flash('Unable to save your feedback. Please contact us.')->error();
                }
            }

            return redirect()->route('post');
        }
    }

//     /**
//      * submit a new link/reference, linked to an idea
//      *
//      * @param Request $request
//      * @param Idea $idea
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function submitLink( Request $request )
//     {
//         $link = new Link;
//         $link->user_id = \Auth::id();

// //        TODO: allow multiple submission types
//         $link->text = $request->get( 'text' );
//         $link->type = 1;
//         $link->link_type = rand(1, 5);

//         if( $idea->links()->save($link) ) {
//             flash("Link submitted!");
//         } else {
//             flash("Unable to save your link. Please contact us.")->error();
//         }

//         return redirect()->back();
//     }

}
