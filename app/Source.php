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
}
