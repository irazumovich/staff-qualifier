<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Goal extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'goals';

    protected $appends = [
        'task_ile',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'confirmation_method',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function goalResources()
    {
        return $this->hasMany(Resource::class, 'goal_id', 'id');
    }

    public function qualificationGoalsQualifications()
    {
        return $this->belongsToMany(Qualification::class);
    }

    public function getTaskIleAttribute()
    {
        return $this->getMedia('task_ile');
    }
}
