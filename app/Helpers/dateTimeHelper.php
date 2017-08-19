<?php

use Carbon\Carbon;

if (! function_exists('dateForHumans')) {
    /**
     * convert the date to difference for humans
     *
     * @param  timestamp $date
     */
    function dateForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}

if (! function_exists('dateSimple')) {
    /**
     * convert the date to simple date and time in LA timezone
     *
     * @param  timestamp $date
     */
    function dateSimple($date)
    {
        $date = $date->setTimezone('America/Los_Angeles');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F jS, Y, g:i a');
    }
}