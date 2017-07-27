<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Requests\FeedbackRequest;
use App\Task;
use App\User;
use App\Idea;
use App\Link;
use App\Comment;
use App\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    private function avgRatings($idea)
    {
        $allRatings = $idea->ratings;
        $ratings = [];
        $types = $allRatings->pluck('type')->unique()->values()->all();
        foreach ($types as $type) {
            $ratings[Rating::QUALITIES[$type]] = $allRatings->where('type',$type)->avg();
        }
        return collect($ratings);
    }

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
        $view = 'ideas.single';
        $data = [];

        $data['idea'] = $idea;
        $data['ratings'] = $this->avgRatings($idea);
        $data['rating_keys'] = $data['ratings']->keys()->all();
        $data['links'] = $idea->links;

        return view($view, $data);
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

    public function showComment($id)
    {
        $view = 'ideas.comment';

        $idea = Idea::find($id);

        $data = ['idea' => $idea];

        return view($view, $data);
    }

    public function showSubmitLink($id)
    {
        $idea = Idea::find($id);
        $view = 'ideas.submitLink';
        $data = ['idea' => $idea];

        return view($view, $data);
    }

    public function showAssess($id)
    {
        $view = 'ideas.rating';
        $idea = Idea::find($id);
        $ratings = Rating::QUALITIES;
        $data = ['idea' => $idea, 'ratings' => $ratings];

        return view($view, $data);
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

    public function comment( Request $request, Idea $idea )
    {
        $comment = new Feedback;
        $comment->user_id = \Auth::id();
//        $comment->idea_id = $idea->id;
        $comment->comment = $request->get( 'text' );

        if( $idea->feedback()->save($comment) ) {
            flash("Comment submitted!");
        } else {
            flash("Unable to save your comment. Please contact us.")->error();
        }

        return redirect()->back();
    }

    public function assess( Request $request, Idea $idea )
    {
        $qualities = Rating::QUALITIES;

        $ratings = collect([]);
        foreach($qualities as $key=>$quality) {
            $rating = new Rating;
            $rating->type = $key;
            $rating->rating = $request->get( $quality );
            if ($rating->rating != null)
                $ratings->push($rating);
        }

        if ( $idea->ratings()->saveMany($ratings->all()) ) {
            flash("Ratings submitted!");
        } else {
            flash("Unable to save your ratings. Please contact us.")->error();
        }

        return redirect()->back();
    }

    public function submitLink( Request $request, Idea $idea )
    {
        $link = new Link;
        $link->user_id = \Auth::id();

//        TODO: allow multiple submission types
        $link->text = $request->get( 'text' );
        $link->type = 1;

        if( $idea->links()->save($link) ) {
            flash("Link submitted!");
        } else {
            flash("Unable to save your link. Please contact us.")->error();
        }

        return redirect()->back();
    }

}
