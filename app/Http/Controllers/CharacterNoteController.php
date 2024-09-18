<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterNoteController extends Controller
{
    public function store(Request $request, string $characterId)
    {
        $current_user = Auth::user();
        $character = $current_user->characters()->findOrFail($characterId);
        $character->notes()->create([
            'note' => $request->input('note'),
        ]);

        return redirect(route('characters.show', $character->id));
    }

    public function destroy(Request $request, string $characterId, string $noteId)
    {
        $current_user = Auth::user();
        $character = $current_user->characters()->findOrFail($characterId);
        $character->notes()->find($noteId)->delete();

        return redirect(route('characters.show', $character->id));
    }
}
