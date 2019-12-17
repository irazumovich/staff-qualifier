<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    public $table = 'resources';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'link',
        'goal_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }
}
