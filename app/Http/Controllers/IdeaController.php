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

class IdeaController extends Controller
{
    /**
     * Table of Contents:
     * -private functions
     * -show functions
     * -post functions
     */


    //------------ private functions -----------------

    /**
     * calculates the average ratings on an idea TODO: possibly reorganize database -store ratings in feedback- when design complete
     *
     * @param $idea
     * @return \Illuminate\Support\Collection
     */
    private function avgRatings($idea)
    {
        $allRatings = $idea->ratings;
        $ratings = [];
        $types = $allRatings->pluck('type')->unique()->values()->all();
        foreach ($types as $type) {
            $ratings[Rating::QUALITIES[$type]] = $allRatings->where('type',$type)->avg();
        }
        return collect($ratings);
    }

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

    /**
     * view page to show a single idea
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $idea = Idea::find($id);
        $view = 'ideas.single';
        $data = [];

        $data['idea'] = $idea;
        // $data['ratings'] = $this->avgRatings($idea);
        // $data['rating_keys'] = $data['ratings']->keys()->all();
        $data['links'] = $idea->links->sortBy('link_type');
        $data['feedbacks'] = $idea->feedback->sortByDesc('created_at');

        return view($view, $data);
    }

    /**
     * view page to show the combine ideas page --unused
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCombination()
    {
        $view = 'ideas.combination';
        $data = [];
        $data['ideas'] = Idea::get();

        return view($view, $data);
    }

    /**
     * view page to submit a new idea
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubmitIdea()
    {
        $submitIdea = Task::where('type', '=', 80)->first();

        return redirect()->action(
            'TaskController@showTask', [$submitIdea->id, 0, 0]
        );
    }

    /**
     * view page to comment on an idea
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showComment($id)
    {
        $view = 'ideas.comment';

        $idea = Idea::find($id);

        $data = ['idea' => $idea];

        return view($view, $data);
    }

    /**
     * view page to submit a new link
     * TODO: allow submission of link to either allow new idea or existing idea
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubmitLink($id)
    {
        $idea = Idea::find($id);
        $view = 'ideas.submitLink';
        $data = ['idea' => $idea];

        return view($view, $data);
    }

    /**
     * view page to rate an idea
     * TODO: possibly change database structure -- combine ratings into feedback
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAssess($id)
    {
        $view = 'ideas.rating';
        $idea = Idea::find($id);
        $ratings = Rating::QUALITIES;
        $data = ['idea' => $idea, 'ratings' => $ratings];

        return view($view, $data);
    }

    //------------------ post methods ------------------------

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
                // 'name' => 'required|string',
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

            return redirect()->route('do');
        }
        else {
            if ($idea->text) {
                if ($idea->save() ) {
                    flash("Your idea was submitted!")->success();
                } else {
                    flash('Unable to save your feedback. Please contact us.')->error();
                }
            }

            return redirect()->route('post');
        }
    }

    /**
     * combine two ideas - creates a new idea and makes this idea a parent of the old ideas
     * --unused
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function combine( Request $request )
    {
        $subideas = $request->except( ['_token', 'name'] );

        $idea = new Idea;
        $idea->text = $request->get( 'name' );

        if( $idea->save() ) {
            flash("Idea submitted!");
        } else {
            flash("Unable to save your idea. Please contact us.")->error();
        }

        foreach($subideas as $subidea) {
            $child = Idea::find($subidea);
            $child->makeChildOf($idea);
            $child->save();
        }

        return redirect()->back();
    }

    /**
     * create a new comment, linked to an idea
     *
     * @param Request $request
     * @param Idea $idea
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment( Request $request, Idea $idea )
    {
        $comment = new Feedback;
        $comment->user_id = \Auth::id();
//        $comment->idea_id = $idea->id;
        $comment->comment = $request->get( 'text' );

        if( $idea->feedback()->save($comment) ) {
            flash("Comment submitted!");
        } else {
            flash("Unable to save your comment. Please contact us.")->error();
        }

        return redirect()->back();
    }

    /**
     * create a new Rating, linked to an idea
     * TODO: see above on ratings
     *
     * @param Request $request
     * @param Idea $idea
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assess( Request $request, Idea $idea )
    {
        $qualities = Rating::QUALITIES;

        $ratings = collect([]);
        foreach($qualities as $key=>$quality) {
            $rating = new Rating;
            $rating->type = $key;
            $rating->rating = $request->get( $quality );
            if ($rating->rating != null)
                $ratings->push($rating);
        }

        if ( $idea->ratings()->saveMany($ratings->all()) ) {
            flash("Ratings submitted!");
        } else {
            flash("Unable to save your ratings. Please contact us.")->error();
        }

        return redirect()->back();
    }

//     /**
//      * submit a new link/reference, linked to an idea
//      *
//      * @param Request $request
//      * @param Idea $idea
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function submitLink( Request $request, Idea $idea )
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
