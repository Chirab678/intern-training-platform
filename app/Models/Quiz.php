<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'passing_score',
        'time_limit',
        'is_mandatory'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function calculateScore($answers)
    {
        $totalPoints = 0;
        $earnedPoints = 0;

        foreach ($this->questions as $question) {
            $totalPoints += $question->points;
            
            if (isset($answers[$question->id]) && 
                $answers[$question->id] == $question->correct_answer) {
                $earnedPoints += $question->points;
            }
        }

        return $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
    }
}

