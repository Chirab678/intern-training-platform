@extends('layouts.app')

@section('title', 'Créer un module')

@section('content')
<div class="container py-8 max-w-lg mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold mb-6 flex items-center"><i class="fas fa-plus mr-2 text-primary-600"></i>Créer un nouveau module</h1>
        <form method="POST" action="{{ route('modules.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-gray-700 font-semibold mb-2">Titre</label>
                <input type="text" name="title" id="title" class="form-input w-full" value="{{ old('title') }}" required autofocus>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="form-input w-full" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="month" class="block text-gray-700 font-semibold mb-2">Mois</label>
                <input type="number" name="month" id="month" class="form-input w-full" value="{{ old('month') }}" min="1" max="3" required>
                @error('month')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="order" class="block text-gray-700 font-semibold mb-2">Ordre d'affichage</label>
                <input type="number" name="order" id="order" class="form-input w-full" value="{{ old('order') }}" min="1" required>
                @error('order')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="target_audience" class="block text-gray-700 font-semibold mb-2">Public cible</label>
                <select name="target_audience" id="target_audience" class="form-input w-full" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="intern" {{ old('target_audience') == 'intern' ? 'selected' : '' }}>Stagiaire</option>
                    <option value="entrepreneur" {{ old('target_audience') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                    <option value="both" {{ old('target_audience') == 'both' ? 'selected' : '' }}>Les deux</option>
                </select>
                @error('target_audience')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="estimated_duration" class="block text-gray-700 font-semibold mb-2">Durée estimée (minutes)</label>
                <input type="number" name="estimated_duration" id="estimated_duration" class="form-input w-full" value="{{ old('estimated_duration') }}" min="1" required>
                @error('estimated_duration')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex space-x-2 mt-6">
                <button type="submit" class="px-6 py-2 rounded-lg text-lg font-bold bg-green-600 hover:bg-green-700 text-white shadow transition"><i class="fas fa-check mr-2"></i>Créer</button>
                <a href="{{ route('modules.index') }}" class="px-6 py-2 rounded-lg text-lg font-bold bg-gray-500 hover:bg-gray-700 text-white shadow transition">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
