<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	const CONDITION_GENERIC_HOLISTIC = 0;
	const CONDITION_GENERIC_MICROTASK_OPEN = 1;
	const CONDITION_GENERIC_MICROTASK_CLOSED = 2;
	const CONDITION_PERSONAL_HOLISTIC = 3;
	const CONDITION_PERSONAL_MICROTASK_OPEN = 4;
	const CONDITION_PERSONAL_MICROTASK_CLOSED = 5;
	const CONDITION_MIN = 0;
	const CONDITION_MAX = 5;

	const TYPES = [
        0 => 'general',
        1 => 'seeded',
        2 => 'team',
        3 => 'lab',
    ];

    use Notifiable, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'condition', 'consent', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
    protected $appends = [
    	'name'
    ];

    protected function getNameAttribute() {
    	$guest = 'Guest';
    	if ($this->fname == $guest) {
    		return $this->fname;
    	} else {
    		return $this->fname . ' ' . $this->lname;
    	}
    }

	/**
	 * Returns available conditions
	 *
	 * @param string $type
	 *
	 * @return array
	 */
    public static function getConditions($type = '') {
    	$personal = [
		    'PERSONAL_HOLISTIC' => static::CONDITION_PERSONAL_HOLISTIC,
		    'PERSONAL_MICROTASK_OPEN' => static::CONDITION_PERSONAL_MICROTASK_OPEN,
		    'PERSONAL_MICROTASK_CLOSED' => static::CONDITION_PERSONAL_MICROTASK_CLOSED,
	    ];

    	$generic = [
		    'GENERIC_HOLISTIC' => static::CONDITION_GENERIC_HOLISTIC,
		    'GENERIC_MICROTASK_OPEN' => static::CONDITION_GENERIC_MICROTASK_OPEN,
		    'GENERIC_MICROTASK_CLOSED' => static::CONDITION_GENERIC_MICROTASK_CLOSED,
	    ];

    	switch ($type) {
		    case 'personal':
		    	return $personal;
		    case 'generic':
		    	return $generic;
		    default:
		    	return $personal + $generic;
	    }
    }

	/**
	 * Feedback this user has generated
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function feedback()
	{
		return $this->hasMany( 'App\Feedback' );
	}

	/**
	 * Ideas this user has submitted
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ideas()
	{
		return $this->hasMany( 'App\Idea' );
	}

	/**
	 * Links this user has submitted
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function links()
	{
		return $this->hasMany( 'App\Link' );
	}

	/**
	 * Ratings this user has submitted
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ratings()
	{
		return $this->hasMany( 'App\Rating' );
	}

	/**
	 * taskHists this user has tracked
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function taskHist()
	{
		return $this->hasMany( 'App\TaskHist' );
	}

	/**
	 * Get User's recommended tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function recommendedTasks()
	{
		return $this->belongsToMany('App\Task', 'recommendations')->withTimestamps();
	}

	/**
	 * Query for holistic-type condition users
	 *
	 * @return mixed
	 */
	public static function holistic()
	{
		return static::whereIn( 'condition', [
			static::CONDITION_GENERIC_HOLISTIC,
			static::CONDITION_PERSONAL_HOLISTIC
		] );
	}

	/**
	 * Query for microtask-type condition users
	 *
	 * @return mixed
	 */
	public static function microtask()
	{
		return static::whereIn( 'condition', [
			static::CONDITION_GENERIC_MICROTASK_OPEN,
			static::CONDITION_GENERIC_MICROTASK_CLOSED,
			static::CONDITION_PERSONAL_MICROTASK_OPEN,
			static::CONDITION_PERSONAL_MICROTASK_CLOSED,
		] );
	}

	/**
	 * Query for personalized condition users
	 *
	 * @return mixed
	 */
	public static function personalized()
	{
		return static::whereIn( 'condition', [
			static::CONDITION_PERSONAL_HOLISTIC,
			static::CONDITION_PERSONAL_MICROTASK_OPEN,
			static::CONDITION_PERSONAL_MICROTASK_CLOSED,
		]);
	}

	/**
     * returns count of the user's total contributions, regardless of status
     *
     * @return str
     */
    public function getSubmittedAttribute()
    {
        return $contributions = count($this->taskHist->where('action', 1));

        	// $contributions = count($this->taskHist->where('status', 1)) + 
 //            count(auth()->user()->ideas) + 
 //            count(auth()->user()->links) + 
 //            intval(count(auth()->user()->ratings) / 3)
    }

	
}
