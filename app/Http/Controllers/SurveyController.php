<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index($page)
    {
        $views = [
            1 => 'survey.pageOne',
            2 => 'survey.pageTwo',
            3 => 'survey.pageThree',
            4 => 'survey.pageFour',
            5 => 'survey.pageFive',
            6 => 'home'
        ];

        $view = $views[$page];

        $data = ['page' => $page];
        return view($view, $data);
    }

    public function storeResponse(Request $request, $page)
    {
        $checks = collect($request->all())->except(['_token']);
        $response          = new Response;
//		$feedback->comment = $request->get( 'comment' );
        $response->user_id = \Auth::id();
        $response->type = $page;

        $test = "";

        foreach($checks as $check) {
            $test .= " " . $check;
        }

        $response->response = $test;

        if ( $response->save() ) {
            flash("Response recorded!")->success();
        } else {
            flash('Unable to save your response. Please contact us.')->error();
        }

//        $activity = $request->get('activity');
//        return $this->index($page+1);
//        return redirect()->back();
        return $this->index($page+1);
    }
}
