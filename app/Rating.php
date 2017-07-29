<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //things to rate go here, increment and follow structure
    const QUALITIES = [
        1 => 'originality',
        2 => 'practicality',
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
