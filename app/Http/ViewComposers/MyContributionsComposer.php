<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Task;
use Illuminate\View\View;

class MyContributionsComposer
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
        // $view->with('latestMovie', end($this->movieList));
        if (!Auth::guest()) {
            $count = count(auth()->user()->feedback) + count(auth()->user()->ideas);
        }
        else {
            $count = null;
        }
        $view->with('myFeedbackCount', $count);
    }
}