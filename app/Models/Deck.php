<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperDeck
 */
class Deck extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\DeckFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, \App\Models\Deck>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Card>
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function draw(): ?Card
    {
        $cards = $this
            ->drawPile()
            ->get();

        if (count($cards) === 0) {
            return null;
        }

        $card = $cards->random();
        $card->update(['discarded_at' => now()]);

        return $card;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Card>
     */
    public function drawPile(): HasMany
    {
        return $this
            ->hasMany(Card::class)
            ->whereNull('discarded_at')
            ->whereNull('character_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Card>
     */
    public function discardPile(): HasMany
    {
        return $this
            ->hasMany(Card::class)
            ->whereNotNull('discarded_at')
            ->whereNull('character_id')
            ->orderBy('discarded_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Card>
     */
    public function handPile(): HasMany
    {
        return $this
            ->hasMany(Card::class)
            ->whereNull('discarded_at')
            ->whereNotNull('character_id');
    }

    /**
     * Recalls all cards from the characters.
     * Optionally only recalls cards from a given character.
     */
    public function recall(?int $characterId): int
    {
        $query = $this
            ->cards()
            ->whereNull('discarded_at');

        if ($characterId) {
            $query = $query->where('character_id', $characterId);
        } else {
            $query = $query->whereNotNull('character_id');
        }

        return $query
            ->update(['character_id' => null, 'discarded_at' => now()]);
    }

    /**
     * Shuffles the discard pile into the deck, leaves all hand piles untouched.
     */
    public function shuffle(): int
    {
        return $this
            ->discardPile()
            ->update(['discarded_at' => null]);
    }
}
