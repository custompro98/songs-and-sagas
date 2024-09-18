<?php

namespace Database\Seeders;

use App\Models\PartyMember;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $users = User::factory(3)->create();

        $characters = [];
        array_push($characters, ...$this->createCharacters($user));

        foreach ($users as $rando) {
            array_push($characters, ...$this->createCharacters($rando));
        }

        $parties = $user->parties()->createMany([
            [
                'name' => 'X and the Beefy Boys',
                'description' => '5e campaign party',
                'join_code' => '123456',
            ],
            [
                'name' => 'The Wind Section',
                'description' => 'Pirate Börg group of adventurers',
                'join_code' => '654321',
            ],
            [
                'name' => 'Five Guys',
                'description' => 'Pirate Börg group of adventurers, who like burgers',
                'join_code' => '456123',
            ],
        ]);

        foreach ($characters as $character) {
            $idx = rand(0, count($parties) - 1);

            PartyMember::create([
                'party_id' => $parties[$idx]->id,
                'character_id' => $character->id,
            ]);
        }
    }

    private function createCharacters(User $user)
    {
        $characters = $user->characters()->createMany([
            [
                'name' => $this->faker->name(),
                'pronouns' => 'they/them',
                'vanori' => 'Ox',
                'str' => '2',
                'dex' => '2',
                'wil' => '3',
                'hrt' => '4',
                'resilience_current' => 10,
                'resilience_max' => 13,
                'experience' => 0,
                'armor' => 4,
            ],
            [
                'name' => $this->faker->name(),
                'pronouns' => 'he/him',
                'vanori' => 'Raven',
                'str' => '4',
                'dex' => '2',
                'wil' => '3',
                'hrt' => '2',
                'resilience_current' => 5,
                'resilience_max' => 9,
                'experience' => 0,
                'armor' => 4,
            ],
        ]);

        foreach ($characters as $character) {
            $inventory = $character->inventory()->create();

            $inventory->inventoryItems()->createMany([
                ['name' => 'Sword', 'note' => 'd6 damage', 'quantity' => 1],
                ['name' => '', 'note' => '', 'quantity' => 0],
                ['name' => 'Torches', 'note' => 'emit light for 1 hour', 'quantity' => 10],
                ['name' => '', 'note' => '', 'quantity' => 0],
                ['name' => 'Backpack', 'note' => 'Does not add additional carrying capacity', 'quantity' => 1],
                ['name' => '', 'note' => '', 'quantity' => 0],
            ]);
        }

        return $characters;
    }
}
