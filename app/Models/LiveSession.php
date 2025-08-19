<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'instructor_name',
        'scheduled_at',
        'duration',
        'meeting_url',
        'target_audience',
        'is_mandatory',
        'max_participants'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime'
    ];

    public function isUpcoming()
    {
        return $this->scheduled_at->isFuture();
    }

    public function isLive()
    {
        $now = now();
        $endTime = $this->scheduled_at->addMinutes($this->duration);
        
        return $now->between($this->scheduled_at, $endTime);
    }
}
