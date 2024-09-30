<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableDeckStoreRequest;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;

class TableDeckController extends Controller
{
    public function store(TableDeckStoreRequest $request): RedirectResponse
    {
        $table = Table::where('id', $request->validated('table_id'))->firstOrFail();
        $existing_deck = $table->tableDeck()->first();

        if ($existing_deck) {
            $existing_deck->deck_id = $request->validated('deck_id');
            $existing_deck->save();
        } else {
            $table->tableDeck()->create(['deck_id' => $request->validated('deck_id')]);
        }

        return redirect(route('tables.show', $table->id));
    }
}
