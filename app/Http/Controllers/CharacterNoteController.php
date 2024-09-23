<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterNote;
use Illuminate\Http\Request;

class CharacterNoteController extends Controller
{
    public function store(Request $request, Character $character)
    {
        $character->notes()->create([
            'note' => $request->input('note'),
        ]);

        return redirect(route('characters.show', $character->id));
    }

    public function destroy(Character $character, CharacterNote $note)
    {
        $character = $note->character()->first();
        $note->delete();

        return redirect(route('characters.show', $character->id));
    }
}
