@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">Statistiques de progression</h1>
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Progression globale</h2>
        <p class="text-lg">{{ $stats['overall'] ?? 0 }}%</p>
    </div>
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Modules complétés</h2>
        <ul class="list-disc pl-6">
            @foreach($stats['completed_modules'] ?? [] as $module)
                <li>{{ $module->title }}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <h2 class="text-xl font-semibold mb-2">Quizzes réussis</h2>
        <ul class="list-disc pl-6">
            @foreach($stats['passed_quizzes'] ?? [] as $quiz)
                <li>{{ $quiz->title }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
