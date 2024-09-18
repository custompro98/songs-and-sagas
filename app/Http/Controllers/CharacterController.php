<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character[] $characters */
        $characters = $current_user->characters()->get();

        return view('characters.index', ['characters' => $characters]);
    }

    public function show(Request $request, string $id)
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character $character */
        $character = $current_user->characters()->find($id);

        return view('characters.show', ['character' => $character]);
    }

    public function generate(Request $request)
    {
        $current_user = Auth::user();

        $character = $current_user->characters()->create([
            'name' => 'Ilnir',
            'pronouns' => 'he/him',
            'vanori' => 'Elk',
            'str' => 1,
            'dex' => 1,
            'wil' => 1,
            'hrt' => 1,
            'resilience_current' => 10,
            'resilience_max' => 10,
            'experience' => 0,
            'armor' => 4,
        ]);

        $inventory = $character->inventory()->createQuietly();

        $inventory->inventoryItems()->createManyQuietly([
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
        ]);

        return redirect(route('characters.show', $character->id));
    }

    public function update(Request $request, string $id)
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character $character */
        $character = $current_user->characters()->findOrFail($id);
        $updates = $request->all();
        $updates['experience'] = 0;

        for ($i = 0; $i < 8; $i++) {
            if (isset($updates['experience-'.$i]) && $updates['experience-'.$i] === 'on') {
                $updates['experience'] += 1;
            } else {
                break;
            }
        }

        $character->update($updates);

        return redirect(route('characters.show', $character->id));
    }

    public function destroy(Request $request, string $id)
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character $character */
        $character = $current_user->characters()->findOrFail($id);

        $character->delete();

        return redirect(route('characters.index'));
    }
}
