<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\CharacterNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharacterNoteController extends Controller
{
    public function store(Request $request, Character $character): RedirectResponse
    {
        $character->notes()->create([
            'note' => $request->input('note'),
        ]);

        return redirect(route('characters.show', $character->id));
    }

    public function update(Request $request, CharacterNote $note): RedirectResponse
    {
        $note->update([
            'note' => $request->input('note'),
        ]);

        return redirect(route('characters.show', $note->character->id));
    }

    public function destroy(Character $character, CharacterNote $note): RedirectResponse
    {
        $character = $note->character()->first();
        $note->delete();

        return redirect(route('characters.show', $character->id));
    }
}
