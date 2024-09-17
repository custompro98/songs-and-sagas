<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Relations\BelongsToThrough;
use Znck\Eloquent\Traits\BelongsToThrough as BelongsToThroughTrait;

class InventoryItem extends Model
{
    use BelongsToThroughTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'quantity',
    ];

    public function character(): BelongsToThrough
    {
        return $this->belongsToThrough(Character::class, Inventory::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
