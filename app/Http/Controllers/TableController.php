<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;
use App\Models\Table;
use Auth;
use DB;
use Faker;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;

class TableController extends Controller
{
    public function index(): View
    {
        $current_user = Auth::user();
        $table_ids = $this->tables($current_user->id)->get()->pluck('id');
        /** @var \App\Models\Table[] $tables */
        $tables = Table::whereIn('id', $table_ids)->get();

        return view('tables.index', ['tables' => $tables]);
    }

    public function show(Table $table): View
    {
        $current_user = Auth::user();

        $party = $table->party()->first();
        $tableParty = is_null($party) ? null : $party->tableParty()->first();
        $characters = is_null($party) ? [] : $party->characters()->get();
        $tableDeck = $table->tableDeck()->first();
        $deck = $table->deck()->first();
        $decks = $current_user->decks()->get();

        return view('tables.show', [
            'table' => $table,
            'party' => $party,
            'tableParty' => $tableParty,
            'characters' => $characters,
            'decks' => $decks,
            'deck' => $deck,
            'tableDeck' => $tableDeck,
        ]);
    }

    public function create(): View
    {
        return view('tables.create');
    }

    public function store(TableStoreRequest $request): RedirectResponse
    {
        $current_user = Auth::user();

        $table = $current_user->tables()->create($request->validated());

        return redirect(route('tables.show', $table->id));
    }

    public function edit(Table $table): View
    {
        return view('tables.edit', ['table' => $table]);
    }

    public function update(TableUpdateRequest $request, Table $table): RedirectResponse
    {
        $table->update($request->validated());

        return redirect(route('tables.show', $table->id));
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

    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();

        return redirect(route('tables.index'));
    }

    /*
     * Select tables which belong to the current user, or
     * have a character belonging to the current user.
     *
     * SELECT tables.*
     * FROM tables t
     * LEFT JOIN table_parties tp ON t.id = tp.table_id
     * LEFT JOIN parties p ON tp.party_id = p.id
     * LEFT JOIN party_members pm ON tp.party_id = pm.party_id
     * LEFT JOIN characters c ON pm.character_id = c.id
     * WHERE (
     *          p.user_id = <current_user_id>
     *       OR c.user_id = <current_user_id>
     *       OR t.user_id = <current_user_id>
     * )
     * GROUP BY p.id
     */
    private function tables(int $user_id): Builder
    {
        return DB::table('tables')
            ->selectRaw('tables.id')
            ->leftJoin('table_parties', 'tables.id', '=', 'table_parties.table_id')
            ->leftJoin('parties', 'table_parties.party_id', '=', 'parties.id')
            ->leftJoin('party_members', 'table_parties.party_id', '=', 'party_members.party_id')
            ->leftJoin('characters', 'party_members.character_id', '=', 'characters.id')
            ->where(function ($query) use ($user_id) {
                $query
                    ->where('parties.user_id', $user_id)
                    ->orWhere('characters.user_id', $user_id)
                    ->orWhere('tables.user_id', $user_id);
            });
    }
}
