<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function show(Assignment $assignment)
    {
        $user = Auth::user();
        
        if (!$assignment->module->isAccessibleForUser($user)) {
            return redirect()->route('dashboard')
                           ->with('error', 'Cet assignment n\'est pas accessible.');
        }

        return view('assignments.show', compact('assignment'));
    }

    public function submit(Assignment $assignment, Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'submission' => 'required|string|max:10000'
        ]);

        $progress = UserProgress::where([
            'user_id' => $user->id,
            'module_id' => $assignment->module_id
        ])->first();

        if ($progress) {
            $submissions = $progress->assignment_submissions ?? [];
            $submissions[$assignment->id] = [
                'content' => $request->submission,
                'submitted_at' => now(),
                'status' => 'submitted'
            ];
            
            $progress->update(['assignment_submissions' => $submissions]);
            
            return redirect()->back()
                           ->with('success', 'Assignment soumis avec succès !');
        }

        return redirect()->back()
                       ->with('error', 'Erreur lors de la soumission.');
    }
}
