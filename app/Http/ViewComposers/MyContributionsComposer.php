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
     * THIS COMPOSER IS NOT USED ANYMORE.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Auth::guest()) {
            $count = auth()->user()->submitted;
        }
        else {
            $count = null;
        }
        $view->with('myFeedbackCount', $count);
    }
}