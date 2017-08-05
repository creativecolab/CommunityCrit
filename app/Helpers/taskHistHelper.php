<?php

use App\TaskHist;
use Illuminate\Http\Request;

if (! function_exists('createTaskHistory')) {
    /**
     * create a task history record
     *
     * @param  Request $request
     */
    function createTaskHist(Request $request, $action)
    {
        $taskHist = new TaskHist;
        $taskHist->user_id = \Auth::id();
        $taskHist->idea_id = $request->get( 'idea' );
        $taskHist->task_id = $request->get( 'task' );
        $taskHist->link_id = $request->get( 'link' );
        $taskHist->action = $action;
        $taskHist->save();
    }
}

// if (! function_exists('updateTaskHist')) {
//     /**
//      * create a task history record
//      *
//      * @param  Request $request
//      */
//     function updateTaskHist(Request $request, $action)
//     {
//         $task_id = $request->get( 'task' );
//         $idea_id = $request->get( 'idea' );
//         $link_id = $request->get( 'link' );
//         $user_id = \Auth::id();

//         $taskHist = TaskHist::where('user_id', $user_id)
//             ->where('task_id', $task_id)
//             ->where('idea_id', $idea_id)
//             ->where('link_id', $link_id);

//         $taskHist->update(['action' => $action]);

//         return true;
//     }
// }