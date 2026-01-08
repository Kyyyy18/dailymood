<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyMood extends Model
{
    protected $fillable = [
        'mood_id',
        'reason',
        'mood_date',
    ];

    protected $casts = [
        'mood_date' => 'date',
    ];

    /**
     * Get the mood that owns the daily mood.
     */
    public function mood(): BelongsTo
    {
        return $this->belongsTo(Mood::class);
    }
}
