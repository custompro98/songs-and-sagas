<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyMemberController extends Controller
{
    public function store(Request $request)
    {
        $party = Party::where('join_code', $request->joinCode)->firstOrFail();
        $party->partyMembers()->create([
            'character_id' => $request->characterId,
        ]);

        return redirect(route('parties.show', $party->id));
    }
}
