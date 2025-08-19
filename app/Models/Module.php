<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'month',
        'order',
        'target_audience',
        'is_mandatory',
        'estimated_duration'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function getProgressForUser($userId)
    {
        return $this->userProgress()->where('user_id', $userId)->first();
    }

    public function isAccessibleForUser(User $user)
    {
        // Vérifier si le module est pour le bon type d'utilisateur
        if ($this->target_audience !== 'both' && $this->target_audience !== $user->user_type) {
            return false;
        }

        // Vérifier si l'utilisateur est au bon mois
        if ($this->month > $user->current_month) {
            return false;
        }

        // Vérifier si les modules précédents sont terminés
        $previousModules = Module::where('target_audience', $user->user_type)
                                 ->orWhere('target_audience', 'both')
                                 ->where('month', '<=', $this->month)
                                 ->where('order', '<', $this->order)
                                 ->get();

        foreach ($previousModules as $previousModule) {
            $progress = $previousModule->getProgressForUser($user->id);
            if (!$progress || $progress->status !== 'completed') {
                return false;
            }
        }

        return true;
    }
}