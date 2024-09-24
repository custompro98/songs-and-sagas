<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Relations\BelongsToThrough;
use Znck\Eloquent\Traits\BelongsToThrough as BelongsToThroughTrait;

/**
 * @mixin IdeHelperInventoryItem
 */
class InventoryItem extends Model
{
    use BelongsToThroughTrait;

    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\InventoryItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'quantity',
    ];

    /**
     * @return \Znck\Eloquent\Relations\BelongsToThrough<\App\Models\Character, $this>
     */
    public function character(): BelongsToThrough
    {
        return $this->belongsToThrough(Character::class, Inventory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Inventory, \App\Models\InventoryItem>
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
