<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $current_user = $request->user();

        /** @var \App\Models\Character[] $characters */
        $characters = $current_user->characters()->get();

        return view('characters.index', ['characters' => $characters, 'user' => $current_user]);
    }

    public function show(Request $request, string $id)
    {
        $current_user = $request->user();

        /** @var \App\Models\Character $character */
        $character = $current_user->characters()->find($id);

        return view('characters.show', ['character' => $character, 'user' => $current_user]);
    }

    public function generate(Request $request)
    {
        $current_user = $request->user();

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

        return redirect(route('characters.index'));
    }

    public function destroy(Request $request, string $id)
    {
        $current_user = $request->user();

        /** @var \App\Models\Character $character */
        $character = $current_user->characters()->find($id);

        $character->delete();

        return redirect(route('characters.index'));
    }
}
