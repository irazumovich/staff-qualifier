<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGoal extends Model
{
    protected $table = 'goals_users';
    protected $fillable = [
        'goal_id',
        'user_id',
        'status'
    ];
}
