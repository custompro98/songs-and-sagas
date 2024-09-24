<?php

namespace App\Popos\Card;

class Deck
{
    /** @var \App\Popos\Card\Card[] */
    private array $deck;

    /** @var \App\Popos\Card\Card[] */
    private array $discard;

    public function __construct()
    {
        $this->deck = [];
        $this->discard = [];

        foreach (Suit::cases() as $suit) {
            foreach (Rank::cases() as $rank) {
                $this->deck[] = new Card($suit, $rank);
            }
        }
    }

    /**
     * Draw a card from the deck, if the deck is empty,
     * shuffle the discard and then draw from the newly
     * shuffled deck.
     */
    public function draw(): Card
    {
        if ($this->isEmpty()) {
            $this->shuffle();
        }

        $idx = (int) array_rand($this->deck);
        [$card] = array_splice($this->deck, $idx, 1);

        array_push($this->discard, $card);

        return $card;
    }

    public function isEmpty(): bool
    {
        return count($this->deck) === 0;
    }

    public function shuffle(): void
    {
        $this->deck = array_merge($this->discard, $this->deck);
        $this->discard = [];
    }
}
