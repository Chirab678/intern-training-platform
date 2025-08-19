@extends('layouts.app')

@section('title', $module->title)

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">{{ $module->title }}</h1>
    <div class="mb-4">
        <p class="text-gray-700">{{ $module->description }}</p>
        <p class="text-sm text-gray-500">Mois : {{ $module->month }}</p>
    </div>
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Quizzes</h2>
        @if($module->quizzes->count())
            <ul class="list-disc pl-6">
                @foreach($module->quizzes as $quiz)
                    <li>{{ $quiz->title }} ({{ $quiz->questions->count() }} questions)</li>
                @endforeach
            </ul>
        @else
            <p>Aucun quiz pour ce module.</p>
        @endif
    </div>
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Assignments</h2>
        @if($module->assignments->count())
            <ul class="list-disc pl-6">
                @foreach($module->assignments as $assignment)
                    <li>{{ $assignment->title }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucun assignment pour ce module.</p>
        @endif
    </div>
    <div class="flex flex-wrap gap-2 items-center mt-6">
        <form method="POST" action="{{ route('modules.complete', $module) }}" id="complete-module-form">
            @csrf
            <button type="submit" class="px-5 py-2 rounded-lg text-base font-bold bg-green-600 hover:bg-green-800 text-white shadow transition"><i class="fas fa-check mr-2"></i>Marquer comme terminé</button>
        </form>
        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
            <a href="{{ route('modules.edit', $module) }}" class="px-5 py-2 rounded-lg text-base font-bold bg-yellow-500 hover:bg-yellow-700 text-white shadow transition"><i class="fas fa-edit mr-2"></i>Modifier</a>
            <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Supprimer ce module ?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2 rounded-lg text-base font-bold bg-red-600 hover:bg-red-800 text-white shadow transition"><i class="fas fa-trash mr-2"></i>Supprimer</button>
            </form>
        @endif
    </div>
</div>
@endsection
