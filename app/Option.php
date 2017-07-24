<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use CrudTrait;

    protected $fillable = ['text', 'type'];

    public function tasks()
    {
        return $this->belongsToMany( 'App\Task' );
    }
}
