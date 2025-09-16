<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Day extends Model
{
    protected $fillable = ['program_id', 'day_number'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'day_exercise')
            ->withPivot(['id', 'sets', 'reps', 'rpe', 'rest', 'notes'])
            ->withTimestamps();
    }
}
