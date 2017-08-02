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
