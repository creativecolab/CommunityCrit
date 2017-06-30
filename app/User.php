<?php

namespace App;

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

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password',
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
    	return $this->fname . ' ' . $this->lname;
    }

	/**
	 * Returns available conditions
	 *
	 * @return array
	 */
    public static function getConditions() {
    	return [
    	    'GENERIC_HOLISTIC' => static::CONDITION_GENERIC_HOLISTIC,
	        'GENERIC_MICROTASK_OPEN' => static::CONDITION_GENERIC_MICROTASK_OPEN,
	        'GENERIC_MICROTASK_CLOSED' => static::CONDITION_GENERIC_MICROTASK_CLOSED,
	        'PERSONAL_HOLISTIC' => static::CONDITION_PERSONAL_HOLISTIC,
	        'PERSONAL_MICROTASK_OPEN' => static::CONDITION_PERSONAL_MICROTASK_OPEN,
	        'PERSONAL_MICROTASK_CLOSED' => static::CONDITION_PERSONAL_MICROTASK_CLOSED,
	    ];
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
	 * Get User's recommended tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function recommendedTasks()
	{
		return $this->belongsToMany('App\Task', 'recommendations');
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
}
