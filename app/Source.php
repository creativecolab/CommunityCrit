<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
	use CrudTrait;

    protected $fillable = [
        'name',
	    'text',
    ];

	/**
	 * Tasks this source has
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function tasks()
    {
    	return $this->hasMany('App\Source');
    }
}
