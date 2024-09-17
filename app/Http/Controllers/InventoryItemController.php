<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function update(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('characters.show', $item->character->id);
    }
}
