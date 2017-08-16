<?php

use App\TaskHist;
use Illuminate\Http\Request;

if (! function_exists('createTaskHistory')) {
    /**
     * create a task history record
     *
     * @param  Request $request
     */
    function createTaskHist($task_id, $idea_id, $link_id, $ques_id, $action = null)
    {
        $taskHist = new TaskHist;
        $taskHist->user_id = \Auth::id();
        $taskHist->task_id = $task_id;
        $taskHist->idea_id = $idea_id;
        $taskHist->link_id = $link_id;
        $taskHist->ques_id = $ques_id;
        $taskHist->action = $action;
        $taskHist->save();
    }
}

if (! function_exists('updateTaskHist')) {
    /**
     * create a task history record
     *
     * @param  Request $request
     */
    function updateTaskHist(Request $request, $action, $idea_id_custom = null, $task_id_custom = null)
    {
        \Session::put('time2', new \Carbon\Carbon());

        $task_id = $request->get( 'task' );
        $idea_id = $request->get( 'idea' );
        $link_id = $request->get( 'link' );
        $ques_id = $request->get( 'ques' );
        $user_id = \Auth::id();

        if ($task_id_custom) {
            $task_id = $task_id_custom;
        }

        $taskHist = TaskHist::where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->where('idea_id', $idea_id)
            ->where('link_id', $link_id)
            ->orderByDesc("created_at")
            ->first();

        if ($taskHist) {
            $t1 = \Session::pull('time1');
            $t2 = \Session::pull('time2');

            //nul check
            if (!$t1)
                $diff_time_mil = null;
            else {
                $diff_time = $t1->diffinSeconds($t2) + $t1->diff($t2)->f;
                $diff_time_mil = (int)($diff_time * 1000);
                $taskHist->update(['action' => $action, 'time_all' => $diff_time_mil]);
            }
        }

        // TODO: if record is somehow deleted, create it
        //  else {
        //     createTaskHist($task_id, $idea_id, $link_id, $action);
        // }
    }
}

if (! function_exists('updateTaskHistTimer')) {
    function updateTaskHistTimer($task_id, $idea_id, $link_id, $time_typing)
    {
        $user_id = \Auth::id();
        $taskHist = TaskHist::where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->where('idea_id', $idea_id)
            ->where('link_id', $link_id)
//            ->where('ques_id', $ques_id)
            ->orderByDesc('created_at')
            ->first();

        if ($taskHist) {
            if ($time_typing > $taskHist->time_typing)
                $taskHist->update(['time_typing' => $time_typing]);
        }
    }
}

if (! function_exists('createCommentTaskHist')) {
    /**
     * create a task history record for comments
     *
     * @param $idea_id
     * @param $task_id
     */
    function createCommentTaskHist($idea_id, $task_id)
    {
        $taskHist = new TaskHist;
        $taskHist->user_id = \Auth::id();
        $taskHist->idea_id = $idea_id;
        $taskHist->task_id = $task_id;
        $taskHist->action = 7;
        $taskHist->save();
    }
}