<?php

namespace App\Popos\Card;

class Card
{
    private Suit $suit;

    private Rank $value;

    public function __construct(Suit $suit, Rank $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function suit(): Suit
    {
        return $this->suit;
    }
}
