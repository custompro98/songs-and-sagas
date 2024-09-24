<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCharacterNote
 */
class CharacterNote extends Model
{
    /** @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\CharacterNoteFactory> */
    use HasFactory;

    protected $fillable = [
        'character_id',
        'note',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Character, \App\Models\CharacterNote>
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
