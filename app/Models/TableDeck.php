<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTableDeck
 */
class TableDeck extends Model
{
    protected $fillable = [
        'table_id',
        'deck_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Table, \App\Models\TableDeck>
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Deck, \App\Models\TableDeck>
     */
    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }
}
