<?php

namespace App\Models;

use App\Popos\Card\Suit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCard
 */
class Card extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;

    protected $fillable = [
        'deck_id',
        'suit',
        'rank',
        'discarded_at',
        'character_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Deck, \App\Models\Card>
     */
    public function deck(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Character, \App\Models\Card>
     */
    public function character(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Sends the card to the character's hand.
     */
    public function take(Character $character): bool
    {
        return $this
            ->update([
                'discarded_at' => null,
                'character_id' => $character->id,
            ]);
    }

    /**
     * Sends the card to the discard pile of the deck.
     */
    public function discard(): bool
    {
        return $this
            ->update([
                'discarded_at' => now(),
                'character_id' => null,
            ]);
    }

    public function suit(): string
    {
        switch ($this->suit) {
            case Suit::HEARTS:
                return '♥';
            case Suit::DIAMONDS:
                return '♦';
            case Suit::CLUBS:
                return '♣';
            case Suit::SPADES:
                return '♠';
        }
    }
}
