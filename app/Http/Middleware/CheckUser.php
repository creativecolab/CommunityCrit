<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( !Auth::guest()) {
            return $next( $request );
        }
        
        return redirect()->route('login'); // If user is not an admin.
    }
}

