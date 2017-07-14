<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [ 'user_id' , 'activity' ];
    protected $table = 'presurvey';
}
