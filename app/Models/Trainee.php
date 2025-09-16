<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trainee extends Model
{
    protected $fillable = ['name', 'age', 'height', 'weight', 'gender', 'notes', 'phone', 'birthdate'];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
