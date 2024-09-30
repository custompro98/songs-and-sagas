<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Auth;
use Faker;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    public function index(): View
    {
        $current_user = Auth::user();
        $tables = $current_user->tables()->with('party')->get();

        return view('tables.index', ['tables' => $tables]);
    }

    public function show(Table $table): View
    {
        $current_user = Auth::user();

        $party = $table->party()->first();
        $tableParty = is_null($party) ? null : $party->tableParty()->first();
        $characters = is_null($party) ? [] : $party->characters()->get();
        $deck = $table->deck()->first();
        $decks = $current_user->decks()->get();

        return view('tables.show', [
            'table' => $table,
            'party' => $party,
            'tableParty' => $tableParty,
            'characters' => $characters,
            'decks' => $decks,
            'deck' => $deck,
        ]);
    }

    public function generate(): RedirectResponse
    {
        $current_user = Auth::user();
        $faker = Faker\Factory::create();

        $table = $current_user->tables()->create([
            'name' => $faker->name().'\'s Table',
        ]);

        return redirect(route('tables.show', $table->id));
    }
}
