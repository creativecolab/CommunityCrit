<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Link;
use App\Feedback;
use App\User;
use App\TaskHist;
use App\Question;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
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

    const version_user = 55;

    //------------ private functions -----------------

    //---------------- show functions ----------------

    /**
     * show all pending items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPending()
    {
    	$view = 'admin.moderation.pending';
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
    	$view = 'admin.moderation.update';
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

        $questions = Question::all()->where('status', $status);
        $data['questions'] = $questions;

        return view($view, $data);
    }

    /**
     * show all rejected items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showByStatus($status)
    {
    	$view = 'admin.moderation.showByStatus';
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

    /**
     * show user summary
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserSummary()
    {
        $view = 'admin.summary.users';
        $data = [];

        $users = User::all()->where('type', 0)->where('id','>',static::version_user);//("admin", "!=", 1);
        // $taskHists = TaskHist::where();

        $rows = collect();
        $actions = ['submitted' => [1], 'skipped' => [5], 'exited' => [2, 3, 4], 'bounced' => [null]];

        // total
        $allIdeas = collect();
        $allLinks = collect();
        $allFeedbacks = collect();
        $allRatings = collect();
        $allComments = collect();

        // users
        foreach ($users as $key => $user) {
            $row = collect();
            $row->put('user_id', $user->id);
            $row->put('user_initials', $user->fname[0].$user->lname[0]);
            $row->put('created_at', $user->created_at->tz('America/Los_Angeles'));
            if ($user->taskHist->sortByDesc('updated_at')->first()['updated_at']){
                $row->put('last_visited', $user->taskHist->sortByDesc('updated_at')->first()['updated_at']->tz('America/Los_Angeles'));
            }
            else {
                $row->put('last_visited', $user->taskHist->sortByDesc('updated_at')->first()['updated_at']);
            }
            $ideas = $user->taskHist->where('task_id', 2);
            $allIdeas = $allIdeas->merge($ideas);
            $links = $user->taskHist->whereIn('task_id', [3, 4]);
            $allLinks = $allLinks->merge($links);
            $feedbacks = $user->taskHist->whereNotIn('task_id', [1, 2, 3, 4, 11]);
            $allFeedbacks = $allFeedbacks->merge($feedbacks);
            $ratings = $user->taskHist->where('task_id', 11);
            $allRatings = $allRatings->merge($ratings);
            $total = $user->taskHist;
            $groups = ['ideas' => $ideas, 'links' => $links, 'feedbacks' => $feedbacks, 'ratings' => $ratings, 'total' => $total];
            foreach ($groups as $key => $group) {
                $actions = ['submitted' => [1], 'skipped' => [5], 'exited' => [2, 3, 4], 'bounced' => [null]];
                foreach ($actions as $keyAct=>$action) {
                    $count = count($group->whereIn('action', $action));
                    $count = $count ? $count : '-';
                    $row->put($key.'-'.$keyAct, $count);
                }
            }

            //comments
            $comments = $user->taskHist->where('task_id', 1);
            $allComments = $allComments->merge($comments);
            $count = count($comments->whereIn('action', 1));
            $count = $count ? $count : '-';
            $row->put('comments-submitted', $count);

            $rows->push($row);
        }

        // total
        $allTotal = collect();
        $allTotal = $allTotal->merge($allIdeas);
        $allTotal = $allTotal->merge($allLinks);
        $allTotal = $allTotal->merge($allFeedbacks);
        $allTotal = $allTotal->merge($allRatings);
        $allGroups = ['ideas' => $allIdeas, 'links' => $allLinks, 'feedbacks' => $allFeedbacks, 'ratings' => $allRatings, 'total' => $allTotal];

        // total - #
        $totalNum = collect();
        foreach ($allGroups as $key => $group) {
            foreach ($actions as $keyAct=>$action) {
                $count = count($group->whereIn('action', $action));
                $totalNum->put($key.'-'.$keyAct, $count);
            }
        }
        //allComments - #
        $count = count($allComments->whereIn('action', 1));
        $count = $count ? $count : '-';
        $totalNum->put('comments-submitted', $count);
        $data['totalNum'] = $totalNum;

        // total - %
        $totalPer = collect();
        foreach ($allGroups as $key => $group) {
            foreach ($actions as $keyAct=>$action) {
                $count = count($group->whereIn('action', $action));
                $totalPer->put($key.'-'.$keyAct, sprintf("%.1f%%", count($group) ? ($count / count($group) * 100) : 0));
            }
        }
        $data['totalPer'] = $totalPer;

        $data['rows'] = $rows;

        //count new users created today
        $todayCount = 0;
        foreach (User::get() as $usr) {
            if ($usr->created_at->tz('America/Los_Angeles')->isToday())
                $todayCount += 1;
        }
        $data['today_count'] = $todayCount;

        return view($view, $data);
    }

    /**
     * show submission summary
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubmissionSummary()
    {
        $view = 'admin.summary.submissions';
        $data = [];

        $ideas = Idea::all()
            ->where('status', 1)
            ->sortByDesc('created_at');
        $data['ideas'] = $ideas;

        $links = Link::all()
            ->where('status', 1)
            ->sortByDesc('created_at');
        $data['links'] = $links;

        $feedbacks = Feedback::all()
            ->where('status', 1)
            ->sortByDesc('created_at');
        $data['feedbacks'] = $feedbacks;

        return view($view, $data);
    }

    public function showIdeaNames()
    {
        $view = 'admin.ideaNames';
        $data = [];

        $ideas = Idea::all();

        $data['ideas'] = $ideas;

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

    /**
    * update status of questions
    *
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function updateQuestionsStatus(Request $request, $status) {
        $questions = Question::all()->where('status', $status);

        $count = 0;
        $user_id = \Auth::id();
        $now = Carbon::now();

        foreach($questions as $question) {
            $action = $request->get( 'question'.$question->id );
            if ($action != null && $question->status != $action) {
                $count += 1;
                $question->update(['status' => $action, 'moderated_at' => $now, 'moderated_by' => $user_id]);
            }
        }

        if ($count) {
            flash("Moderation status updated for ". $count . " question" . ($count == 1 ? "" : "s") . "!")->success();
        } else {
            flash("No changes were selected.")->error();
        }

        return redirect()->back();
    }

    public function updateNames(Request $request)
    {
        $inputs = $request->all();
        $ids = Idea::all()->pluck('id');

        foreach($inputs as $key=>$val) {
            if ($ids->contains($key) && $val != null) {
                $idea = Idea::find($key);
                if ($idea->old_name == null) {
                    $idea->old_name = $idea->name;
                    $idea->name = $val;
                }
                else {
                    $idea->name = $val;
                }
                $idea->save();
            }
        }

        return redirect()->back();
    }
}