<?php

namespace App\Services;

use App\Models\User;
use App\Models\Module;
use App\Models\UserProgress;

class ProgressService
{
    public function getUserStats(User $user)
    {
        $totalModules = Module::where('target_audience', $user->user_type)
                             ->orWhere('target_audience', 'both')
                             ->count();

        $completedModules = UserProgress::where('user_id', $user->id)
                                       ->where('status', 'completed')
                                       ->count();

        $inProgressModules = UserProgress::where('user_id', $user->id)
                                        ->where('status', 'in_progress')
                                        ->count();

        $overallProgress = $totalModules > 0 ? 
                          round(($completedModules / $totalModules) * 100) : 0;

        return [
            'total_modules' => $totalModules,
            'completed_modules' => $completedModules,
            'in_progress_modules' => $inProgressModules,
            'overall_progress' => $overallProgress,
            'current_month' => $user->current_month
        ];
    }

    public function updateUserMonth(User $user)
    {
        $startDate = $user->internship_start_date;
        
        if (!$startDate) {
            return false;
        }

        $daysDiff = now()->diffInDays($startDate);
        $currentMonth = min(3, max(1, ceil($daysDiff / 30)));

        if ($currentMonth !== $user->current_month) {
            $user->update(['current_month' => $currentMonth]);
            return true;
        }

        return false;
    }

    public function canAccessNextModule(User $user, Module $module)
    {
        // Vérifier les prérequis
        $previousModules = Module::where('target_audience', $user->user_type)
                                 ->orWhere('target_audience', 'both')
                                 ->where('month', '<=', $module->month)
                                 ->where('order', '<', $module->order)
                                 ->get();

        foreach ($previousModules as $prevModule) {
            $progress = UserProgress::where([
                'user_id' => $user->id,
                'module_id' => $prevModule->id
            ])->first();

            if (!$progress || $progress->status !== 'completed') {
                return false;
            }
        }

        return true;
    }

    public function getModuleStatus(User $user, Module $module)
    {
        $progress = UserProgress::where([
            'user_id' => $user->id,
            'module_id' => $module->id
        ])->first();

        if (!$progress) {
            return $this->canAccessNextModule($user, $module) ? 'available' : 'locked';
        }

        return $progress->status;
    }
}