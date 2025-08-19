<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Assignment;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        // MOIS 1 - Modules de base
        $module1 = Module::create([
            'title' => 'Fondamentaux du Marketing Digital',
            'description' => 'Introduction aux concepts essentiels du marketing digital moderne',
            'content' => 'Ce module couvre les bases du marketing digital, les différents canaux et stratégies.',
            'month' => 1,
            'order' => 1,
            'target_audience' => 'both',
            'is_mandatory' => true,
            'estimated_duration' => 120
        ]);

        $module2 = Module::create([
            'title' => 'Analyse de Marché et Veille Concurrentielle',
            'description' => 'Techniques d\'analyse de marché et outils de veille',
            'content' => 'Apprendre à analyser son marché et surveiller la concurrence efficacement.',
            'month' => 1,
            'order' => 2,
            'target_audience' => 'both',
            'is_mandatory' => true,
            'estimated_duration' => 90
        ]);

        $module3 = Module::create([
            'title' => 'Outils Professionnels Essentiels',
            'description' => 'Maîtrise des outils indispensables (Google Analytics, Canva, etc.)',
            'content' => 'Formation pratique sur les outils professionnels les plus utilisés.',
            'month' => 1,
            'order' => 3,
            'target_audience' => 'both',
            'is_mandatory' => true,
            'estimated_duration' => 150
        ]);

        // MOIS 2 - Spécialisation
        $module4 = Module::create([
            'title' => 'Culture d\'Entreprise et Intégration',
            'description' => 'Comprendre et s\'adapter à la culture d\'entreprise',
            'content' => 'Module spécialisé pour l\'intégration en entreprise.',
            'month' => 2,
            'order' => 1,
            'target_audience' => 'intern',
            'is_mandatory' => true,
            'estimated_duration' => 80
        ]);

        $module5 = Module::create([
            'title' => 'Entrepreneuriat et Gestion d\'Entreprise',
            'description' => 'Bases de la création et gestion d\'entreprise',
            'content' => 'Module pour entrepreneurs : création, gestion, financement.',
            'month' => 2,
            'order' => 1,
            'target_audience' => 'entrepreneur',
            'is_mandatory' => true,
            'estimated_duration' => 180
        ]);

        $module6 = Module::create([
            'title' => 'Communication Professionnelle',
            'description' => 'Techniques de communication en milieu professionnel',
            'content' => 'Développer ses compétences de communication.',
            'month' => 2,
            'order' => 2,
            'target_audience' => 'both',
            'is_mandatory' => true,
            'estimated_duration' => 100
        ]);

        // MOIS 3 - Application pratique
        $module7 = Module::create([
            'title' => 'Projet Réel - Phase 1',
            'description' => 'Application pratique sur un projet concret',
            'content' => 'Mise en pratique des acquis sur un projet réel.',
            'month' => 3,
            'order' => 1,
            'target_audience' => 'both',
            'is_mandatory' => true,
            'estimated_duration' => 240
        ]);

        $module8 = Module::create([
            'title' => 'Social Media Management Avancé',
            'description' => 'Stratégies avancées de gestion des réseaux sociaux',
            'content' => 'Techniques avancées pour la gestion des réseaux sociaux.',
            'month' => 3,
            'order' => 2,
            'target_audience' => 'both',
            'is_mandatory' => false,
            'estimated_duration' => 120
        ]);

        // Créer des assignments pour chaque module
        Assignment::create([
            'module_id' => $module1->id,
            'title' => 'Analyse d\'Article - Tendances Marketing 2024',
            'description' => 'Analyser l\'article fourni et identifier les 3 principales tendances marketing',
            'instructions' => 'Lisez l\'article et rédigez une analyse de 500 mots maximum',
            'due_date' => now()->addDays(7),
            'max_points' => 100,
            'submission_type' => 'text'
        ]);

        Assignment::create([
            'module_id' => $module2->id,
            'title' => 'Étude de Cas - Analyse Concurrentielle',
            'description' => 'Réaliser une analyse concurrentielle dans votre secteur',
            'instructions' => 'Choisissez 3 concurrents et analysez leurs stratégies',
            'due_date' => now()->addDays(10),
            'max_points' => 100,
            'submission_type' => 'text'
        ]);

        Assignment::create([
            'module_id' => $module3->id,
            'title' => 'Création Dashboard Google Analytics',
            'description' => 'Configurer un tableau de bord GA4 pour un site e-commerce',
            'instructions' => 'Suivez le tutoriel et soumettez des captures d\'écran',
            'due_date' => now()->addDays(14),
            'max_points' => 100,
            'submission_type' => 'file'
        ]);
    }
}

