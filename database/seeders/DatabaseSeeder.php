<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user->characters()->createMany([
            [
                'name' => 'Uldrid',
                'pronouns' => 'they/them',
                'vanori' => 'Ox',
                'str' => '1',
                'dex' => '0',
                'wil' => '3',
                'hrt' => '-1',
                'resilience_current' => 10,
                'resilience_max' => 13,
                'experience' => 0,
                'armor' => 4,
            ],
            [
                'name' => 'Filbeard',
                'pronouns' => 'he/him',
                'vanori' => 'Raven',
                'str' => '0',
                'dex' => '+2',
                'wil' => '-1',
                'hrt' => '+1',
                'resilience_current' => 5,
                'resilience_max' => 9,
                'experience' => 0,
                'armor' => 4,
            ],
        ]);
    }
}
