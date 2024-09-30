<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTableParty
 */
class TableParty extends Model
{
    protected $fillable = [
        'table_id',
        'party_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Table, \App\Models\TableParty>
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Party, \App\Models\TableParty>
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
}
