<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterNoteController extends Controller
{
    public function store(Request $request, string $characterId)
    {
        $current_user = $request->user();
        $character = $current_user->characters()->find($characterId);
        $character->notes()->create([
            'note' => $request->input('note'),
        ]);

        return redirect(route('characters.show', $characterId));
    }

    public function destroy(Request $request, string $characterId, string $noteId)
    {
        $current_user = $request->user();
        $character = $current_user->characters()->find($characterId);
        $character->notes()->find($noteId)->delete();

        return redirect(route('characters.show', $characterId));
    }
}
