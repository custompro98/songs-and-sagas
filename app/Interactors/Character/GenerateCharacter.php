<?php

namespace App\Interactors\Character;

use App\Contexts\Character\GenerateCharacterContext;
use App\Models\Character;
use App\Popos\Card\Suit;

class GenerateCharacter
{
    private GenerateCharacterContext $context;

    public function __construct(GenerateCharacterContext $context)
    {
        $this->context = $context;
    }

    public function call(): Character
    {
        $vanori = $this->context->faker->randomElement([
            'Bear',
            'Wolf',
            'Raven',
            'Elk',
            'Ox',
            'Owl',
        ]);

        $str = $this->generateAttribute();
        $dex = $this->generateAttribute();
        $wil = $this->generateAttribute();
        $hrt = $this->generateAttribute();
        $max_resilience = 0;

        switch ($vanori) {
            case 'Bear':
                $str = $str + 2;
                $hrt = $hrt + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 10) + 3;
                break;
            case 'Wolf':
                $dex = $dex + 2;
                $wil = $wil + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 8) + 3;
                break;
            case 'Raven':
                $wil = $wil + 2;
                $dex = $dex + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 6) + 3;
                break;
            case 'Elk':
                $hrt = $hrt + 2;
                $str = $str + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 10) + 3;
                break;
            case 'Ox':
                $str = $str + 2;
                $wil = $wil + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 12) + 3;
                break;
            case 'Owl':
                $wil = $wil + 2;
                $hrt = $hrt + 1;
                $max_resilience = $this->context->faker->numberBetween(1, 6) + 3;
                break;
        }

        return new Character([
            'name' => $this->context->faker->name(),
            'pronouns' => $this->context->faker->randomElement(['he/him', 'she/her', 'they/them']),
            'vanori' => $vanori,
            'str' => $str,
            'dex' => $dex,
            'wil' => $wil,
            'hrt' => $hrt,
            'resilience_current' => $max_resilience,
            'resilience_max' => $max_resilience,
            'experience' => 0,
            'armor' => 4,
        ]);
    }

    private function generateAttribute(): int
    {
        $card = $this->context->deck->draw();

        switch ($card->suit()) {
            case Suit::HEARTS:
                return 2;
            case Suit::DIAMONDS:
                return 1;
            case Suit::SPADES:
                return 0;
            case Suit::CLUBS:
                return -1;
        }
    }
}
