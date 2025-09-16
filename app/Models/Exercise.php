<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Exercise extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'description'];

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Day::class, 'day_exercise')
            ->withPivot(['sets', 'reps', 'rpe', 'rest', 'notes'])
            ->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('exercise_image')
            ->singleFile();
    }
}
