<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Znck\Eloquent\Traits\BelongsToThrough as BelongsToThroughTrait;

/**
 * @mixin IdeHelperTable
 */
class Table extends Model
{
    use BelongsToThroughTrait;

    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'join_code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, \App\Models\Table>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<\App\Models\TableDeck>
     */
    public function tableDeck(): HasOne
    {
        return $this->hasOne(TableDeck::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Deck>
     */
    public function deck(): BelongsToMany
    {
        return $this->belongsToMany(Deck::class, TableDeck::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<\App\Models\TableParty>
     */
    public function tableParty(): HasOne
    {
        return $this->hasOne(TableParty::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Party>
     */
    public function party()
    {
        return $this->belongsToMany(Party::class, TableParty::class);
    }
}
