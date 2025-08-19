@extends('layouts.app')

@section('title', 'Tableau de bord Stagiaire')

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">Bienvenue, {{ auth()->user()->name }} !</h1>
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Modules disponibles</h2>
        @if($modules->count())
            <ul class="list-disc pl-6">
                @foreach($modules as $module)
                    <li><a href="{{ route('modules.show', $module) }}" class="text-primary-600 hover:underline">{{ $module->title }}</a></li>
                @endforeach
            </ul>
        @else
            <p>Aucun module disponible pour le moment.</p>
        @endif
    </div>
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Assignments en cours</h2>
        @if($assignments->count())
            <ul class="list-disc pl-6">
                @foreach($assignments as $assignment)
                    <li>{{ $assignment->title }} (Module: {{ $assignment->module->title }})</li>
                @endforeach
            </ul>
        @else
            <p>Aucun assignment en cours.</p>
        @endif
    </div>
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-2">Sessions live à venir</h2>
        @if($liveSessions->count())
            <ul class="list-disc pl-6">
                @foreach($liveSessions as $session)
                    <li>{{ $session->title }} - {{ $session->scheduled_at->format('d/m/Y H:i') }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucune session live à venir.</p>
        @endif
    </div>
    <div>
        <h2 class="text-xl font-semibold mb-2">Statistiques</h2>
        <p>Progression globale : <strong>{{ $stats['overall'] ?? 0 }}%</strong></p>
    </div>
</div>
@endsection
