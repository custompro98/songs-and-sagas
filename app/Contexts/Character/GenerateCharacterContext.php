<?php

namespace App\Contexts\Character;

use App\Popos\Card\Deck;
use Faker;

class GenerateCharacterContext
{
    public Faker\Generator $faker;

    public Deck $deck;

    public function __construct(Faker\Generator $faker, Deck $deck)
    {
        $this->faker = $faker;
        $this->deck = $deck;
    }
}
