<?php

namespace App;

use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use CrudTrait;

    protected $fillable = [
        'text',
        'idea_id',
        'user_id',
        'status',
        'moderated_at',
        'moderated_by',
    ];

    /**
     * idea this question belongs to
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
