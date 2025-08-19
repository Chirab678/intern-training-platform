<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Assignment;
use App\Models\LiveSession;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $progressService;

    public function __construct(ProgressService $progressService)
    {
        $this->progressService = $progressService;
    }

    public function index()
    {
        $user = Auth::user();
        // Ensure $user is an instance of App\Models\User
        if (!$user || !($user instanceof \App\Models\User)) {
            $user = \App\Models\User::where('id', Auth::id())->first();
        }
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Modules disponibles pour l'utilisateur
        $modules = Module::where(function($query) use ($user) {
            $query->where('target_audience', $user->user_type)
                  ->orWhere('target_audience', 'both');
        })
        ->where('month', '<=', $user->current_month)
        ->orderBy('month')
        ->orderBy('order')
        ->with(['userProgress' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->get();

        // Assignments en cours
        $assignments = Assignment::whereHas('module', function($query) use ($user) {
            $query->where('target_audience', $user->user_type)
                  ->orWhere('target_audience', 'both');
        })
        ->where('due_date', '>', now())
        ->orderBy('due_date')
        ->limit(5)
        ->get();

        // Sessions live à venir
        $liveSessions = LiveSession::where('target_audience', $user->user_type)
                                  ->orWhere('target_audience', 'both')
                                  ->where('scheduled_at', '>', now())
                                  ->orderBy('scheduled_at')
                                  ->limit(3)
                                  ->get();

        // Statistiques
        $stats = $this->progressService->getUserStats($user);

        $viewName = $user->isIntern() ? 'dashboard.intern' : 'dashboard.entrepreneur';

        return view($viewName, compact('modules', 'assignments', 'liveSessions', 'stats'));
    }
}

