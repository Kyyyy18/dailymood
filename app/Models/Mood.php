<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mood extends Model
{
    protected $fillable = [
        'name',
        'emoji',
        'image',
        'suggestion',
    ];

    /**
     * Get the daily moods for the mood.
     */
    public function dailyMoods(): HasMany
    {
        return $this->hasMany(DailyMood::class);
    }
}
