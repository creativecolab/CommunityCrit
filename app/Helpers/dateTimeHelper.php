<?php

use Carbon\Carbon;

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