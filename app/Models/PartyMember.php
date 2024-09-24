<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPartyMember
 */
class PartyMember extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\PartyMemberFactory> */
    use HasFactory;

    protected $fillable = [
        'party_id',
        'character_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Party, \App\Models\PartyMember>
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Character, \App\Models\PartyMember>
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
