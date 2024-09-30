<?php

namespace App\Http\Controllers;

use App\Http\Requests\TablePartyStoreRequest;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;

class TablePartyController extends Controller
{
    public function store(TablePartyStoreRequest $request): RedirectResponse
    {
        $table = Table::where('join_code', $request->validated('join_code'))->firstOrFail();
        $table->tableParty()->create([
            'party_id' => $request->validated('party_id'),
        ]);

        return redirect(route('tables.show', $table->id));
    }
}
