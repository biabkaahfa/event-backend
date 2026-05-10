<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 10 événements
        Event::factory()
            ->count(10)
            ->has(
                // Pour chaque événement, créer entre 2 et 8 inscriptions
                Registration::factory()->count(fake()->numberBetween(2, 8)),
                'registrations'
            )
            ->create();
    }
}
