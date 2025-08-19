<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type', // intern, entrepreneur, admin, manager
        'company_name',
        'manager_email',
        'internship_start_date',
        'current_month',
        'role' // new: role field for more granular permissions
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'internship_start_date' => 'date',
    ];

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }


    // Role helpers
    public function isIntern()
    {
        return $this->user_type === 'intern' || $this->role === 'intern';
    }

    public function isEntrepreneur()
    {
        return $this->user_type === 'entrepreneur' || $this->role === 'entrepreneur';
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin' || $this->role === 'admin';
    }

    public function isManager()
    {
        return $this->user_type === 'manager' || $this->role === 'manager';
    }

    public function getOverallProgressAttribute()
    {
        $totalModules = Module::where('target_audience', $this->user_type)
                              ->orWhere('target_audience', 'both')
                              ->count();
        
        if ($totalModules === 0) return 0;

        $completedModules = $this->progress()
                                 ->where('status', 'completed')
                                 ->count();

        return round(($completedModules / $totalModules) * 100);
    }
}
