<?php

namespace App\Http\Controllers;

use App\Contexts\Character\GenerateCharacterContext;
use App\Interactors\Character\GenerateCharacter;
use App\Models\Character;
use App\Popos\Card\Deck;
use Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character[] $characters */
        $characters = $current_user->characters()->get();

        return view('characters.index', ['characters' => $characters]);
    }

    public function show(Character $character)
    {
        return view('characters.show', ['character' => $character]);
    }

    public function generate()
    {
        $current_user = Auth::user();

        $context = new GenerateCharacterContext(Faker\Factory::create(), new Deck);
        $generator = new GenerateCharacter($context);
        $model = $generator->call();
        $character = $current_user->characters()->save($model);

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

    public function update(Request $request, Character $character)
    {
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

    public function destroy(Character $character)
    {
        $character->delete();

        return redirect(route('characters.index'));
    }
}
