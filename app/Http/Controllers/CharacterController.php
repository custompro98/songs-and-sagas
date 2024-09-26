<?php

namespace App\Http\Controllers;

use App\Contexts\Character\GenerateCharacterContext;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Interactors\Character\GenerateCharacter;
use App\Models\Character;
use App\Popos\Card\Deck;
use App\Popos\Character\Armor;
use App\Popos\Character\Pronouns;
use App\Popos\Character\Vanori;
use Faker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index(): View
    {
        $current_user = Auth::user();

        /** @var \App\Models\Character[] $characters */
        $characters = $current_user->characters()->get();

        return view('characters.index', ['characters' => $characters]);
    }

    public function show(Character $character): View
    {
        $armor_options = Armor::cases();

        return view('characters.show', ['character' => $character, 'armor_options' => $armor_options]);
    }

    public function create(): View
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

    public function store(StoreCharacterRequest $request): RedirectResponse
    {

        $current_user = Auth::user();
        $character = $current_user->characters()->create($request->validated());

        $this->createInventory($character);

        return redirect(route('characters.show', $character->id));

    }

    public function generate(): RedirectResponse
    {
        $current_user = Auth::user();

        $context = new GenerateCharacterContext(Faker\Factory::create(), new Deck);
        $generator = new GenerateCharacter($context);
        $model = $generator->call();
        $character = $current_user->characters()->save($model);

        if ($character) {
            $this->createInventory($character);

            return redirect(route('characters.show', $character->id));
        }

        return redirect(route('characters.index'));
    }

    public function update(UpdateCharacterRequest $request, Character $character): RedirectResponse
    {
        $character->update($request->validated());

        return redirect(route('characters.show', $character->id));
    }

    public function destroy(Character $character): RedirectResponse
    {
        $character->delete();

        return redirect(route('characters.index'));
    }

    private function createInventory(Character $character): void
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
