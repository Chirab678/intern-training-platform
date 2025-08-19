<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiveSession;

class LiveSessionSeeder extends Seeder
{
    public function run()
    {
        LiveSession::create([
            'title' => 'Session Q&A - Marketing Digital',
            'description' => 'Session interactive pour répondre à vos questions sur le marketing digital',
            'instructor_name' => 'Marie Dubois',
            'scheduled_at' => now()->addDays(3)->setTime(14, 0),
            'duration' => 90,
            'meeting_url' => 'https://meet.google.com/abc-defg-hij',
            'target_audience' => 'both',
            'is_mandatory' => true,
            'max_participants' => 50
        ]);

        LiveSession::create([
            'title' => 'Atelier Pratique - Google Analytics',
            'description' => 'Formation pratique sur la configuration et l\'utilisation de Google Analytics',
            'instructor_name' => 'Jean Martin',
            'scheduled_at' => now()->addDays(7)->setTime(10, 0),
            'duration' => 120,
            'meeting_url' => 'https://meet.google.com/xyz-uvwx-yz',
            'target_audience' => 'both',
            'is_mandatory' => false,
            'max_participants' => 30
        ]);

        LiveSession::create([
            'title' => 'Masterclass Entrepreneuriat',
            'description' => 'Conseils et stratégies pour entrepreneurs débutants',
            'instructor_name' => 'Sophie Laurent',
            'scheduled_at' => now()->addDays(10)->setTime(16, 0),
            'duration' => 60,
            'meeting_url' => 'https://meet.google.com/ent-repr-eur',
            'target_audience' => 'entrepreneur',
            'is_mandatory' => false,
            'max_participants' => 25
        ]);

        LiveSession::create([
            'title' => 'Intégration en Entreprise - Bonnes Pratiques',
            'description' => 'Comment réussir son intégration en entreprise',
            'instructor_name' => 'Pierre Durand',
            'scheduled_at' => now()->addDays(14)->setTime(11, 0),
            'duration' => 75,
            'meeting_url' => 'https://meet.google.com/int-egr-ent',
            'target_audience' => 'intern',
            'is_mandatory' => true,
            'max_participants' => 40
        ]);
    }
}
