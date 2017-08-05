<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class TaskHist extends Model
{
    const ACTIONS = [
        1 => 'submit',
        2 => 'go to exit - submit',
        3 => 'go to exit - empty',
        4 => 'go to exit - unknown',
        5 => 'skip',
    ];

    use CrudTrait;

    protected $fillable = ['task_id', 'user_id', 'action', 'idea_id', 'link_id', 'time_all', 'time_typing'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_history';
}