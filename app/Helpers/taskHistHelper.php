<?php

use App\TaskHist;
use Illuminate\Http\Request;

if (! function_exists('createTaskHistory')) {
    /**
     * create a task history record
     *
     * @param  Request $request
     */
    function createTaskHist($task_id, $idea_id, $link_id, $action = null)
    {
        $taskHist = new TaskHist;
        $taskHist->user_id = \Auth::id();
        $taskHist->task_id = $task_id;
        $taskHist->idea_id = $idea_id;
        $taskHist->link_id = $link_id;
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
    function updateTaskHist(Request $request, $action)
    {
        $task_id = $request->get( 'task' );
        $idea_id = $request->get( 'idea' );
        $link_id = $request->get( 'link' );
        $user_id = \Auth::id();

        $taskHist = TaskHist::where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->where('idea_id', $idea_id)
            ->where('link_id', $link_id);

        if ($taskHist) {
            $taskHist->update(['action' => $action]);
        }

        // TODO: if record is somehow deleted, create it
        //  else {
        //     createTaskHist($task_id, $idea_id, $link_id, $action);
        // }
    }
}