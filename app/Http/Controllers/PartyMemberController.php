<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartyMemberController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $party = Party::where('join_code', $request->join_code)->firstOrFail();
        $party->partyMembers()->create([
            'character_id' => $request->characterId,
        ]);

        return redirect(route('parties.show', $party->id));
    }
}
