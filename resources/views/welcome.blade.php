<?php
// resources/views/welcome.blade.php
?>
@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-600 via-purple-600 to-blue-600">
    <div class="container mx-auto px-4 py-16">
        <div class="text-center text-white mb-16">
            <h1 class="text-5xl font-bold mb-6">🎓 StageForce</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                La plateforme de formation pour une intégration professionnelle réussie. 
                Développez vos compétences et transformez votre mindset en 3 mois.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Stagiaires -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-3xl text-blue-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Stagiaires en Entreprise</h2>
                    <p class="text-gray-600 mt-2">Formation structurée avec accompagnement managérial</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Parcours personnalisé sur 3 mois
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Sessions live avec experts
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Projets réels en entreprise
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Suivi managérial intégré
                    </li>
                </ul>
                
                <a href="{{ route('register') }}?type=intern" class="block w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold text-center hover:bg-blue-700 transition-colors">
                    Commencer en tant que Stagiaire
                </a>
            </div>

            <!-- Entrepreneurs -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-rocket text-3xl text-purple-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Entrepreneurs / Startups</h2>
                    <p class="text-gray-600 mt-2">Formation autonome axée sur les compétences business</p>
                </div>
                
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Marketing & Communication
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Social Media Management
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Gestion d'entreprise
                    </li>
                    <li class="flex items-center text-gray-700">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Outils low-cost/gratuits
                    </li>
                </ul>
                
                <a href="{{ route('register') }}?type=entrepreneur" class="block w-full bg-purple-600 text-white py-3 px-6 rounded-lg font-semibold text-center hover:bg-purple-700 transition-colors">
                    Commencer en tant qu'Entrepreneur
                </a>
            </div>
        </div>

        <div class="text-center mt-16">
            <p class="text-white mb-4">Vous avez déjà un compte ?</p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </a>
        </div>
    </div>
</div>
@endsection
