<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Link;
use App\Feedback;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ModerationController extends Controller
{
	const STATUSES = array(
		0 => "Pending",
	    1 => "Approved",
	    2 => "Rejected",
	    3 => "Postponed",
	);

	const ACTIONS = array(
		1 => "Approve",
	    2 => "Reject",
	    3 => "Postpone",
	);

    //------------ private functions -----------------

    //---------------- show functions ----------------

    /**
     * show all pending items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPending()
    {
    	$view = 'moderation.pending';
        $data = [];
        $status = 0;

	    $data['actions'] = static::ACTIONS;

        $ideas = Idea::all()->where('status', $status);
        $data['ideas'] = $ideas;

        $links = Link::all()->where('status', $status);
        $data['links'] = $links;

        return view($view, $data);
    }

    /**
     * show all items of a certain status for updating
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateByStatus($status)
    {
    	$view = 'moderation.update';
        $data = [];

        $data['statusKey'] = $status;
        $data['status'] = static::STATUSES[$status];
	    $data['actions'] = array_except(static::STATUSES, [0]);

        $ideas = Idea::all()->where('status', $status);
        $data['ideas'] = $ideas;

        $links = Link::all()->where('status', $status);
        $data['links'] = $links;

        $feedbacks = Feedback::all()->where('status', $status);
        $data['feedbacks'] = $feedbacks;

        return view($view, $data);
    }

    /**
     * show all rejected items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showByStatus($status)
    {
    	$view = 'moderation.showByStatus';
        $data = [];

        $data['status'] = static::STATUSES[$status];

        $ideas = Idea::all()->where('status', $status);
        $data['ideas'] = $ideas;

        $links = Link::all()->where('status', $status);
        $data['links'] = $links;

        $feedbacks = Feedback::all()->where('status', $status);
        $data['feedbacks'] = $feedbacks;

        return view($view, $data);
    }

    //------------------ post methods ------------------------

    /**
    * save status of previously pending ideas
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function savePendingIdeas(Request $request) {
        $ideas = Idea::all()->where('status', 0);

        $count = 0;
        $user_id = \Auth::id();
        $now = Carbon::now();

        foreach($ideas as $idea) {
            $action = $request->get( 'idea'.$idea->id );
            if ($action != null) {
            	$count += 1;
            	$idea->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
        	flash("Moderation status updated for ". $count . " idea" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
        	flash("No changes were selected.")->error();
        }

        return redirect()->back();
    }

    /**
    * save status of previously pending ideas
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function savePendingLinks(Request $request) {
        $links = Link::all()->where('status', 0);

        $count = 0;
        $user_id = \Auth::id();

        foreach($links as $link) {
            $action = $request->get( 'link'.$link->id );
            if ($action != null) {
            	$count += 1;
            	$link->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
        	flash("Moderation status updated for ". $count . " link" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
        	flash("No changes were selected.")->error();
        }
        

        return redirect()->back();
    }

    /**
    * update status of ideas
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function updateIdeasStatus(Request $request, $status) {
        $ideas = Idea::all()->where('status', $status);

        $count = 0;
        $user_id = \Auth::id();
        $now = Carbon::now();

        foreach($ideas as $idea) {
            $action = $request->get( 'idea'.$idea->id );
            if ($action != null && $idea->status != $action) {
            	$count += 1;
            	$idea->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
        	flash("Moderation status updated for ". $count . " idea" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
        	flash("No changes were selected.")->error();
        }

        return redirect()->back();
    }

    /**
    * update status of links
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function updateLinksStatus(Request $request, $status) {
        $links = Link::all()->where('status', $status);

        $count = 0;
        $user_id = \Auth::id();
        $now = Carbon::now();

        foreach($links as $link) {
            $action = $request->get( 'link'.$link->id );
            if ($action != null && $link->status != $action) {
            	$count += 1;
            	$link->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
        	flash("Moderation status updated for ". $count . " link" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
        	flash("No changes were selected.")->error();
        }
        

        return redirect()->back();
    }

    /**
    * update status of feedbacks
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function updateFeedbacksStatus(Request $request, $status) {
        $feedbacks = Feedback::all()->where('status', $status);

        $count = 0;
        $user_id = \Auth::id();
        $now = Carbon::now();

        foreach($feedbacks as $feedback) {
            $action = $request->get( 'feedback'.$feedback->id );
            if ($action != null && $feedback->status != $action) {
            	$count += 1;
            	$feedback->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
        	flash("Moderation status updated for ". $count . " feedback" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
        	flash("No changes were selected.")->error();
        }
        

        return redirect()->back();
    }
}