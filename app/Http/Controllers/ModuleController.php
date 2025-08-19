<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UserProgress;
use App\Models\User;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Services\ModuleService;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    // Show form to create a new module
    public function create()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            $user = User::find($user->id);
        }
        if (!$user->isAdmin() && !$user->isManager()) {
            abort(403, 'Unauthorized');
        }
        return view('modules.create');
    }

    // Store a new module
    public function store(StoreModuleRequest $request, ModuleService $service)
    {
        $service->createModule($request->validated());
        return redirect()->route('modules.index')->with('success', 'Module créé avec succès.');
    }

    // Show form to edit a module
    public function edit(Module $module)
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            $user = User::find($user->id);
        }
        if (!$user->isAdmin() && !$user->isManager()) {
            abort(403, 'Unauthorized');
        }
        return view('modules.edit', compact('module'));
    }

    // Update a module
    public function update(UpdateModuleRequest $request, Module $module, ModuleService $service)
    {
        $service->updateModule($module, $request->validated());
        return redirect()->route('modules.index')->with('success', 'Module mis à jour avec succès.');
    }

    // Delete a module
    public function destroy(Module $module, ModuleService $service)
    {
        $service->deleteModule($module);
        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
    public function index()
    {
        $user = Auth::user();
        
        $modules = Module::where(function($query) use ($user) {
            $query->where('target_audience', $user->user_type)
                  ->orWhere('target_audience', 'both');
        })
        ->orderBy('month')
        ->orderBy('order')
        ->with(['userProgress' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->get();

        return view('modules.index', compact('modules'));
    }

    public function show(Module $module)
    {
        $user = Auth::user();

        if (!$module->isAccessibleForUser($user)) {
            return redirect()->route('modules.index')
                           ->with('error', 'Ce module n\'est pas encore accessible.');
        }

        // Créer ou récupérer le progress
        $progress = UserProgress::firstOrCreate([
            'user_id' => $user->id,
            'module_id' => $module->id
        ], [
            'status' => 'not_started',
            'progress_percentage' => 0
        ]);

        // Marquer comme commencé si pas encore fait
        if ($progress->status === 'not_started') {
            $progress->markAsStarted();
        }

        $module->load(['quizzes.questions', 'assignments']);

        return view('modules.show', compact('module', 'progress'));
    }

    public function complete(Module $module)
    {
        $user = Auth::user();
        
        $progress = UserProgress::where([
            'user_id' => $user->id,
            'module_id' => $module->id
        ])->first();

        if ($progress && $progress->status !== 'completed') {
            $progress->markAsCompleted();
            
            return response()->json([
                'success' => true,
                'message' => 'Module terminé avec succès !'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la completion du module.'
        ]);
    }
}
