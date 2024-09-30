<?php

namespace App\Http\Controllers;

use App\Http\Requests\TablePartyStoreRequest;
use App\Models\Party;
use App\Models\Table;
use App\Models\TableParty;
use Illuminate\Http\RedirectResponse;

class TablePartyController extends Controller
{
    public function store(TablePartyStoreRequest $request): RedirectResponse
    {
        /** @var \App\Models\Table $table */
        $table = Table::findOrFail($request->validated('table_id'));
        /** @var \App\Models\Party $party */
        $party = Party::where('join_code', $request->validated('join_code'))->firstOrFail();
        $table->tableParty()->create([
            'party_id' => $party->id,
        ]);

        return redirect(route('tables.show', $table->id));
    }

    public function destroy(TableParty $tableParty): RedirectResponse
    {
        $tableParty->delete();

        return back();
    }
}
