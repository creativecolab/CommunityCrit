<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Idea extends Node
{
    use CrudTrait;

    protected $fillable = [
        'text',
    ];

    public function links()
    {
        return $this->hasMany( 'App\Link' );
    }

    public function comments()
    {
        return $this->hasMany( 'App\Comment' );
    }
}
