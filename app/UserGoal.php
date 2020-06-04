<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGoal extends Model
{
    protected $table = 'goals_users';
    protected $fillable = [
        'goal_id',
        'user_id',
        'mentor_id',
        'status'
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }


}
