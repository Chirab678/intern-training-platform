@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
        <div class="flex items-center mb-8">
            <div class="h-20 w-20 rounded-full bg-primary-600 flex items-center justify-center text-3xl font-bold text-white mr-6">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-1">Mon Profil</h1>
                <div class="text-gray-500 text-sm">{{ ucfirst(auth()->user()->role ?? auth()->user()->user_type) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nom</label>
                <input type="text" class="form-input w-full" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" class="form-input w-full" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <div>
                <label for="company_name" class="block text-gray-700 font-semibold mb-2">Entreprise</label>
                <input type="text" class="form-input w-full" id="company_name" name="company_name" value="{{ old('company_name', auth()->user()->company_name) }}">
            </div>
            <div>
                <label for="manager_email" class="block text-gray-700 font-semibold mb-2">Email du manager</label>
                <input type="email" class="form-input w-full" id="manager_email" name="manager_email" value="{{ old('manager_email', auth()->user()->manager_email) }}">
            </div>
            <div class="flex space-x-2 mt-6">
                <button type="submit" class="px-6 py-2 rounded-lg text-lg font-bold bg-blue-600 hover:bg-blue-700 text-white shadow transition">Mettre à jour</button>
            </div>
        </form>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-xl font-bold mb-6">Changer le mot de passe</h2>
        <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="current_password" class="block text-gray-700 font-semibold mb-2">Mot de passe actuel</label>
                <input type="password" class="form-input w-full" id="current_password" name="current_password" required>
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Nouveau mot de passe</label>
                <input type="password" class="form-input w-full" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-input w-full" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="flex space-x-2 mt-6">
                <button type="submit" class="px-6 py-2 rounded-lg text-lg font-bold bg-green-600 hover:bg-green-700 text-white shadow transition">Changer le mot de passe</button>
            </div>
        </form>
    </div>
</div>
@endsection
