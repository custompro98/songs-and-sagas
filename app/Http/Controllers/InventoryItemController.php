<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function update(Request $request, InventoryItem $inventory_item): RedirectResponse
    {
        $inventory_item->update($request->all());

        return redirect(route('characters.show', $inventory_item->character->id));
    }
}
