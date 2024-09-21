<?php

use App\Popos\Card\Deck;

test('that the deck can be emptied with 52 draws', function () {
    $deck = new Deck;

    for ($i = 0; $i < 52; $i++) {
        $deck->draw();
    }

    expect($deck->isEmpty())->toBeTrue();
});

test('that 52 unique cards can be drawn from the deck', function () {
    $deck = new Deck;

    $cards = [];
    for ($i = 0; $i < 52; $i++) {
        expect($cards)->not->toContain($deck->draw());
    }
});

test('cards are not drawn in the same order', function () {
    $deck = new Deck;

    $first = $deck->draw();
    $deck->shuffle();
    $second = $deck->draw();

    expect($first)->not->toBe($second);
});
