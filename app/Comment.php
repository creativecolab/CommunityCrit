<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CrudTrait;

    protected $fillable = [
        'text',
        'idea_id',
        'user_id',
        'hidden',
    ];

    /**
     * idea this comment belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idea()
    {
        return $this->belongsTo( 'App\Idea' );
    }

    /**
     * user this comment belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo( 'App\User' );
    }
}
