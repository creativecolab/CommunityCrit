<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Idea;
use App\Link;
use App\Comment;
use App\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        $view = 'ideas.all';
        $data = [];

        $ideas = Idea::get();
        $data['ideas'] = $ideas;

        return view($view, $data);
    }

    public function show($id)
    {
        $idea = Idea::find($id);
    }

    public function submitIdea(Request $request)
    {
        $idea = new Idea;
        $idea->text = $request->get('text');

        if ($idea->save()) {
            flash("Idea submitted!");
        } else {
            flash("Unable to save your idea. Please contact us.")->error();
        }

        return redirect()->back();
    }

    public function showCombination()
    {
        $view = 'ideas.combination';
        $data = [];
        $data['ideas'] = Idea::get();

        return view($view, $data);
    }

    public function showSubmit()
    {
        $view = 'ideas.submitIdea';
        $data = [];

        return view($view, $data);
    }

    public function combine( Request $request )
    {
        $subideas = $request->except( ['_token', 'name'] );

        $idea = new Idea;
        $idea->text = $request->get( 'name' );

        if( $idea->save() ) {
            flash("Idea submitted!");
        } else {
            flash("Unable to save your idea. Please contact us.")->error();
        }

        foreach($subideas as $subidea) {
            $child = Idea::find($subidea);
            $child->makeChildOf($idea);
            $child->save();
        }

        return redirect()->back();

    }

}
