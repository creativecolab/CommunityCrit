<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    const TYPES = [
        1 => 'text',
        2 => 'image',
    ];

    use CrudTrait;

    protected $fillable = [
        'type',
        'image',
        'text',
        'idea_id',
        'user_id',
        'hidden',
    ];

    /**
     * idea this link belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idea()
    {
        return $this->belongsTo( 'App\Idea' );
    }

    /**
     * user this link belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo( 'App\User' );
    }
}
