<?php

namespace App;

use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
// use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    const TYPES = [
        1 => 'text',
        2 => 'image',
    ];

    // use Moderatable;
    use CrudTrait;

    protected $fillable = [
        'type',
        'image',
        'text',
        'idea_id',
        'user_id',
        'hidden',
        'status',
        'moderated_at',
        'moderated_by'
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
     * Task for this comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
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

    // public function getCreatedAtAttribute($date)
    // {
    //     return $this->attributes['created_at'] = Carbon::parse($date)->diffForHumans();
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return $this->attributes['updated_at'] = Carbon::parse($date)->diffForHumans();
    // }
}
