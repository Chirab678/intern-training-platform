<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserProgress;
use App\Http\Requests\QuizSubmissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $user = Auth::user();
        
        if (!$quiz->module->isAccessibleForUser($user)) {
            return redirect()->route('dashboard')
                           ->with('error', 'Ce quiz n\'est pas accessible.');
        }

        $quiz->load('questions');
        
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Quiz $quiz, QuizSubmissionRequest $request)
    {
        $user = Auth::user();
        $answers = $request->answers;
        
        // Calculer le score
        $score = $quiz->calculateScore($answers);
        
        // Récupérer le progress du module
        $progress = UserProgress::where([
            'user_id' => $user->id,
            'module_id' => $quiz->module_id
        ])->first();

        if ($progress) {
            // Sauvegarder le score
            $quizScores = $progress->quiz_scores ?? [];
            $quizScores[$quiz->id] = [
                'score' => $score,
                'answers' => $answers,
                'submitted_at' => now()
            ];
            
            $progress->update(['quiz_scores' => $quizScores]);
            
            // Vérifier si le quiz est réussi
            $passed = $score >= $quiz->passing_score;
            
            return response()->json([
                'success' => true,
                'score' => $score,
                'passed' => $passed,
                'passing_score' => $quiz->passing_score,
                'message' => $passed ? 'Félicitations ! Quiz réussi.' : 'Quiz échoué. Vous pouvez le retenter.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la soumission du quiz.'
        ]);
    }
}

