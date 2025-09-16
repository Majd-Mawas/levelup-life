<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['trainee_id', 'title'];


    public function trainee(): BelongsTo
    {
        return $this->belongsTo(Trainee::class);
    }

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }
}
