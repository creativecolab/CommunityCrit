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

    const LINK_TYPES = [
        1 => 'Design Guideline',
        2 => 'Project Goal',
        3 => 'Project Constraint',
        4 => 'Reported Issue',
        5 => 'Example',
        6 => 'Story',
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
        'moderated_by',
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

    /**
     * returns link type text
     *
     * @return str
     */
    public function getTypeStrAttribute()
    {
        $types = static::LINK_TYPES;
        return $types[$this->link_type];
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
