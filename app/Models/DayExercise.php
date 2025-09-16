<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DayExercise extends Model
{
    protected $table = 'day_exercise';
    
    protected $fillable = [
        'day_id', 
        'exercise_id', 
        'sets', 
        'reps', 
        'rpe', 
        'rest', 
        'notes'
    ];

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
