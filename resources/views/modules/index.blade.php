@extends('layouts.app')

@section('title', 'Modules')

@section('content')
<div class="container py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Liste des modules</h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
            <a href="{{ route('modules.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i> Nouveau module
            </a>
        @endif
    </div>
    @if($modules->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($modules as $module)
                <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                    <div>
                        <a href="{{ route('modules.show', $module) }}" class="text-xl font-semibold text-primary-700 hover:underline">{{ $module->title }}</a>
                        <div class="text-sm text-gray-500 mb-2">Mois {{ $module->month }}</div>
                        <div class="text-gray-700 mb-4 line-clamp-2">{{ Str::limit($module->description, 80) }}</div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('modules.show', $module) }}" class="px-5 py-2 rounded-lg text-base font-bold bg-primary-600 hover:bg-primary-800 text-white shadow transition">Voir</a>
                        @if(auth()->user()->isAdmin() || auth()->user()->isManager())
                            <a href="{{ route('modules.edit', $module) }}" class="px-5 py-2 rounded-lg text-base font-bold bg-yellow-500 hover:bg-yellow-700 text-white shadow transition">Modifier</a>
                            <form action="{{ route('modules.destroy', $module) }}" method="POST" onsubmit="return confirm('Supprimer ce module ?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-2 rounded-lg text-base font-bold bg-red-600 hover:bg-red-800 text-white shadow transition">Supprimer</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Aucun module disponible.</p>
    @endif
</div>
@endsection
