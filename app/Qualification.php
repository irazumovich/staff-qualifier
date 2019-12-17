<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualification extends Model
{
    use SoftDeletes;

    public $table = 'qualifications';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'sign',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'next_qualification',
    ];

    public function userQualificationsUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function qualification_goals()
    {
        return $this->belongsToMany(Goal::class);
    }
}
