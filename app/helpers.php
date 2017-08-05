<?php

use App\TaskHist;
use Illuminate\Http\Request;

if (! function_exists('createTaskHistory')) {
    /**
     * create a task history record
     *
     * @param  Request $request
     */
    function createTaskHistory(Request $request)
    {
        $taskHist = new TaskHist;
        $taskHist->user_id = \Auth::id();
        $taskHist->idea_id = $request->get( 'idea' );
        $taskHist->task_id = $request->get( 'task' );
        $taskHist->link_id = $request->get( 'link' );
        $taskHist->action = 1;
        $taskHist->save();
    }
}