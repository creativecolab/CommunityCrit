<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Idea;
use App\Link;
use App\Feedback;
use Illuminate\View\View;

class ModerationComposer
{
    // public $variable;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->variable = 1;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $counts = collect([]);
        $statuses = 4;
        if (Auth::user()->admin) {
            $ideas = Idea::all();
            $links = Link::all();
            $feedbacks = Feedback::all();

            for ($i = 0; $i < $statuses; $i++) { 
                $counts->push(
                    count($ideas->where('status', $i)) +
                    count($links->where('status', $i)) +
                    count($feedbacks->where('status', $i))
                );
            }
        } else {
            $count = null;
        }



        $important = count($ideas->where('status', 0)) +
            count($links->where('status', 0));

        $send = array(
            $counts,
            $important,
        );

        $view->with('modData', $send);
    }
}