<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'join_code',
    ];

    protected $appends = ['size'];

    public function getSizeAttribute(): int
    {
        return $this->characters()->count();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'party_members');
    }

    public function partyMembers(): HasMany
    {
        return $this->hasMany(PartyMember::class);
    }
}
