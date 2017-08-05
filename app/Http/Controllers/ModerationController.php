<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Link;
use App\Feedback;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
	const ACTIONS = array(
		    1 => "Approve",
		    2 => "Reject",
		    3 => "Postpone",
		);

    //------------ private functions -----------------

    //---------------- show functions ----------------

    /**
     * view page to show all pending items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPending()
    {
    	$view = 'moderation.pending';
        $data = [];

	    $data['actions'] = static::ACTIONS;

        $ideas = Idea::pending()->get();
        $data['ideas'] = $ideas;

        $links = Link::pending()->get();
        $data['links'] = $links;

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
        $ideas = Idea::pending()->get();

        $count = 0;

        foreach($ideas as $idea) {
            $action = $request->get( 'idea'.$idea->id );
            if ($action != null) {
            	$count += 1;
            	switch ($action) {
				    case 1:
				        $idea->markApproved();
				        break;
				    case 2:
				        $idea->markRejected();
				        break;
				    case 3:
				        $idea->markPostponed();
				        break;
				}
            }
                
        }

        flash("Moderation status updated for ". $count . " ideas!")->success();

        return redirect()->back();
    }

    /**
    * save status of previously pending ideas
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function savePendingLinks(Request $request) {
        $links = Link::pending()->get();

        $count = 0;

        foreach($links as $link) {
            $action = $request->get( 'link'.$link->id );
            if ($action != null) {
            	$count += 1;
            	switch ($action) {
				    case 1:
				        $link->markApproved();
				        break;
				    case 2:
				        $link->markRejected();
				        break;
				    case 3:
				        $link->markPostponed();
				        break;
				}
            }
                
        }

        flash("Moderation status updated for ". $count . " links!")->success();

        return redirect()->back();
    }
}