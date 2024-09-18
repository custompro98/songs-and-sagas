<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'pronouns',
        'vanori',
        'str',
        'dex',
        'wil',
        'hrt',
        'resilience_current',
        'resilience_max',
        'experience',
        'armor',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(CharacterNote::class);
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    public function inventoryItems(): HasManyThrough
    {
        return $this->hasManyThrough(InventoryItem::class, Inventory::class);
    }

    public function parties(): BelongsToMany
    {
        return $this->belongsToMany(Party::class, 'party_members');
    }
}
