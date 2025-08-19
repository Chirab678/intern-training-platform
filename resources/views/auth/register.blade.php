<?php
// resources/views/auth/register.blade.php
?>
@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-600 to-purple-600 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Créer un compte</h2>
                <p class="text-gray-600">Rejoignez StageForce dès aujourd'hui</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Type d'utilisateur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Type de profil</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative">
                            <input type="radio" name="user_type" value="intern" class="sr-only" {{ old('user_type', request('type')) == 'intern' ? 'checked' : '' }}>
                            <div class="block w-full p-3 border-2 rounded-lg cursor-pointer transition-colors hover:border-primary-300 focus:border-primary-500 user-type-option">
                                <div class="text-center">
                                    <i class="fas fa-graduation-cap text-lg text-blue-600 mb-1"></i>
                                    <div class="text-sm font-medium">Stagiaire</div>
                                </div>
                            </div>
                        </label>
                        <label class="relative">
                            <input type="radio" name="user_type" value="entrepreneur" class="sr-only" {{ old('user_type', request('type')) == 'entrepreneur' ? 'checked' : '' }}>
                            <div class="block w-full p-3 border-2 rounded-lg cursor-pointer transition-colors hover:border-primary-300 focus:border-primary-500 user-type-option">
                                <div class="text-center">
                                    <i class="fas fa-rocket text-lg text-purple-600 mb-1"></i>
                                    <div class="text-sm font-medium">Entrepreneur</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Informations de base -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input id="name" name="name" type="text" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                           value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                           value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>

                <!-- Champs conditionnels pour stagiaires -->
                <div id="intern-fields" class="space-y-4" style="display: none;">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                        <input id="company_name" name="company_name" type="text" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                               value="{{ old('company_name') }}">
                    </div>

                    <div>
                        <label for="manager_email" class="block text-sm font-medium text-gray-700">Email du manager</label>
                        <input id="manager_email" name="manager_email" type="email" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                               value="{{ old('manager_email') }}">
                    </div>

                    <div>
                        <label for="internship_start_date" class="block text-sm font-medium text-gray-700">Date de début de stage</label>
                        <input id="internship_start_date" name="internship_start_date" type="date" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                               value="{{ old('internship_start_date') }}">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Créer mon compte
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500">
                        Vous avez déjà un compte ? Connectez-vous
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
    const internFields = document.getElementById('intern-fields');
    const userTypeOptions = document.querySelectorAll('.user-type-option');

    function toggleInternFields() {
        const selectedType = document.querySelector('input[name="user_type"]:checked')?.value;
        if (selectedType === 'intern') {
            internFields.style.display = 'block';
        } else {
            internFields.style.display = 'none';
        }
    }

    function updateVisualSelection() {
        userTypeOptions.forEach(option => {
            const radio = option.parentElement.querySelector('input[type="radio"]');
            if (radio.checked) {
                option.classList.add('border-primary-500', 'bg-primary-50');
            } else {
                option.classList.remove('border-primary-500', 'bg-primary-50');
            }
        });
    }

    userTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            toggleInternFields();
            updateVisualSelection();
        });
    });

    // Initial setup
    toggleInternFields();
    updateVisualSelection();
});
</script>
@endsection