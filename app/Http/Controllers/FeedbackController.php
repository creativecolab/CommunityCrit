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

class FeedbackController extends Controller
{
    /**
     * Table of Contents:
     * -private functions
     * -show functions
     * -post functions
     */


    //------------ private functions -----------------

    // /**
    //  * calculates the average ratings on an idea TODO: possibly reorganize database -store ratings in feedback- when design complete
    //  *
    //  * @param $idea
    //  * @return \Illuminate\Support\Collection
    //  */
    // private function avgRatings($idea)
    // {
    //     $allRatings = $idea->ratings;
    //     $ratings = [];
    //     $types = $allRatings->pluck('type')->unique()->values()->all();
    //     foreach ($types as $type) {
    //         $ratings[Rating::QUALITIES[$type]] = $allRatings->where('type',$type)->avg();
    //     }
    //     return collect($ratings);
    // }

    //---------------- show functions ----------------

    // /**
    //  * view page to show all ideas
    //  *
    //  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    //  */
    // public function index()
    // {
    //     $view = 'feedback.all';
    //     $data = [];

    //     $ideas = Idea::get();
    //     $data['ideas'] = $ideas;

    //     return view($view, $data);
    // }

    /**
     * view page to show all ideas
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMyFeedback()
    {
        $view = 'user.feedback';
        $data = [];

        $feedbacks = Auth()->User()->feedback->sortByDesc('created_at');
        $data['feedbacks'] = $feedbacks;
        $tasks = Task::get();
        $data['tasks'] = $tasks;

        return view($view, $data);
    }

    //------------------ post methods ------------------------

    // /**
    //  * create a new idea
    //  *
    //  * @param Request $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function submitIdea(Request $request)
    // {
    //     $idea = new Idea;
    //     $idea->text = $request->get('text');

    //     if ($idea->save()) {
    //         flash("Idea submitted!");
    //     } else {
    //         flash("Unable to save your idea. Please contact us.")->error();
    //     }

    //     return redirect()->back();
    // }

}
