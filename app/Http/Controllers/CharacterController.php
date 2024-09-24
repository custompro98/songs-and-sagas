<?php

namespace App\Http\Controllers;

use App\Contexts\Character\GenerateCharacterContext;
use App\Http\Requests\StoreCharacterRequest;
use App\Interactors\Character\GenerateCharacter;
use App\Models\Character;
use App\Popos\Card\Deck;
use App\Popos\Character\Armor;
use App\Popos\Character\Pronouns;
use App\Popos\Character\Vanori;
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

    public function create()
    {
        $armor_options = Armor::cases();
        $pronoun_options = Pronouns::cases();
        $vanori_options = Vanori::cases();

        return view('characters.create', [
            'armor_options' => $armor_options,
            'pronoun_options' => $pronoun_options,
            'vanori_options' => $vanori_options,
        ]);
    }

    public function store(StoreCharacterRequest $request)
    {
        $armor = 4;

        switch ($request->input('armor')) {
            case 'd0':
                $armor = 0;
                break;
            case 'd4':
                $armor = 4;
                break;
            case 'd6':
                $armor = 6;
                break;
        }

        $current_user = Auth::user();
        $character = $current_user->characters()->create([
            'name' => $request->input('name'),
            'pronouns' => $request->input('pronouns'),
            'vanori' => $request->input('vanori'),
            'str' => $request->input('str'),
            'dex' => $request->input('dex'),
            'wil' => $request->input('wil'),
            'hrt' => $request->input('hrt'),
            'resilience_current' => $request->input('resilience'),
            'resilience_max' => $request->input('resilience'),
            'experience' => 0,
            'armor' => $armor,
        ]);

        $this->createInventory($character);

        return redirect(route('characters.show', $character->id));

    }

    public function generate()
    {
        $current_user = Auth::user();

        $context = new GenerateCharacterContext(Faker\Factory::create(), new Deck);
        $generator = new GenerateCharacter($context);
        $model = $generator->call();
        $character = $current_user->characters()->save($model);
        $this->createInventory($character);

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

    private function createInventory(Character $character)
    {

        $inventory = $character->inventory()->createQuietly();

        $inventory->inventoryItems()->createManyQuietly([
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
            ['name' => '', 'note' => '', 'quantity' => 0],
        ]);
    }
}
