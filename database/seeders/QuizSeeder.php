<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            $quiz = Quiz::create([
                'module_id' => $module->id,
                'title' => 'Quiz - ' . $module->title,
                'description' => 'Évaluation des connaissances acquises dans ce module',
                'passing_score' => 70,
                'time_limit' => 30,
                'is_mandatory' => true
            ]);

            // Questions pour le module Marketing Digital
            if ($module->title === 'Fondamentaux du Marketing Digital') {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Quel est le principal objectif du marketing digital ?',
                    'options' => [
                        'Vendre plus de produits rapidement',
                        'Créer une relation durable avec les clients',
                        'Réduire les coûts publicitaires',
                        'Augmenter uniquement le trafic web'
                    ],
                    'correct_answer' => 1,
                    'points' => 10,
                    'order' => 1
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Parmi ces canaux, lequel N\'EST PAS un canal de marketing digital ?',
                    'options' => [
                        'Email marketing',
                        'Publicité radio traditionnelle',
                        'Réseaux sociaux',
                        'SEO/Référencement'
                    ],
                    'correct_answer' => 1,
                    'points' => 10,
                    'order' => 2
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Que signifie l\'acronyme "CTA" en marketing digital ?',
                    'options' => [
                        'Customer Target Analysis',
                        'Call To Action',
                        'Content Type Assessment',
                        'Click Through Analytics'
                    ],
                    'correct_answer' => 1,
                    'points' => 10,
                    'order' => 3
                ]);
            }

            // Questions pour le module Analyse de Marché
            if ($module->title === 'Analyse de Marché et Veille Concurrentielle') {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Quelle est la première étape d\'une analyse de marché ?',
                    'options' => [
                        'Collecter les données',
                        'Définir les objectifs de recherche',
                        'Analyser la concurrence',
                        'Segmenter le marché'
                    ],
                    'correct_answer' => 1,
                    'points' => 10,
                    'order' => 1
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Quel outil est le plus adapté pour surveiller les mentions de votre marque ?',
                    'options' => [
                        'Google Analytics',
                        'Google Alerts',
                        'Facebook Ads Manager',
                        'Mailchimp'
                    ],
                    'correct_answer' => 1,
                    'points' => 10,
                    'order' => 2
                ]);
            }

            // Questions génériques pour les autres modules
            if (!in_array($module->title, ['Fondamentaux du Marketing Digital', 'Analyse de Marché et Veille Concurrentielle'])) {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Avez-vous bien compris les concepts présentés dans ce module ?',
                    'options' => [
                        'Oui, parfaitement',
                        'Oui, globalement',
                        'Partiellement',
                        'Non, j\'ai besoin de réviser'
                    ],
                    'correct_answer' => 0,
                    'points' => 10,
                    'order' => 1
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => 'Vous sentez-vous prêt à appliquer ces connaissances ?',
                    'options' => [
                        'Tout à fait prêt',
                        'Prêt avec un peu de pratique',
                        'J\'ai encore des doutes',
                        'Je ne me sens pas prêt'
                    ],
                    'correct_answer' => 0,
                    'points' => 10,
                    'order' => 2
                ]);
            }
        }
    }
}

