<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperParty
 */
class Party extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\PartyFactory> */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, \App\Models\Party>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Character>
     */
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, PartyMember::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\PartyMember>
     */
    public function partyMembers(): HasMany
    {
        return $this->hasMany(PartyMember::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Table, \App\Models\Party>
     */
    public function tableParty()
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Table>
     */
    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class, TableParty::class);
    }
}
