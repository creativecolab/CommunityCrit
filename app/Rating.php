<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //things to rate go here, increment and follow structure
    const QUALITIES = [
        1 => 'original',
        2 => 'feasible',
        3 => 'valuable',
        4 => 'impactful',
        5 => 'likely to visit',
        6 => 'likely to enjoy spending time here',
        7 => 'likely to be positively impacted',
    ];

    protected $fillable = [
        'type',
        'rating',
        'idea_id',
    ];

    public function idea()
    {
        return $this->belongsTo( 'App\Idea' );
    }

}