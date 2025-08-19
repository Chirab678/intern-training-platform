<?php

namespace App\Services;

use App\Models\User;
use App\Models\LiveSession;
use App\Models\Assignment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function sendWelcomeEmail(User $user)
    {
        try {
            // Ici vous pouvez implémenter l'envoi d'email avec Laravel Mail
            Log::info("Email de bienvenue envoyé à {$user->email}");
            return true;
        } catch (\Exception $e) {
            Log::error("Erreur envoi email: " . $e->getMessage());
            return false;
        }
    }

    public function notifyUpcomingSession(LiveSession $session)
    {
        $users = User::where('user_type', $session->target_audience)
                    ->orWhere(function($query) use ($session) {
                        if ($session->target_audience === 'both') {
                            $query->whereIn('user_type', ['intern', 'entrepreneur']);
                        }
                    })
                    ->get();

        foreach ($users as $user) {
            $this->sendSessionReminder($user, $session);
        }
    }

    public function notifyAssignmentDue(Assignment $assignment)
    {
        $users = User::whereHas('progress', function($query) use ($assignment) {
            $query->where('module_id', $assignment->module_id)
                  ->where('status', '!=', 'completed');
        })->get();

        foreach ($users as $user) {
            $this->sendAssignmentReminder($user, $assignment);
        }
    }

    private function sendSessionReminder(User $user, LiveSession $session)
    {
        // Implémentation de l'envoi d'email pour rappel de session
        Log::info("Rappel session envoyé à {$user->email} pour {$session->title}");
    }

    private function sendAssignmentReminder(User $user, Assignment $assignment)
    {
        // Implémentation de l'envoi d'email pour rappel d'assignment
        Log::info("Rappel assignment envoyé à {$user->email} pour {$assignment->title}");
    }
}