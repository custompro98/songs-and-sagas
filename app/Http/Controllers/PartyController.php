<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\PartyMember;
use Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartyController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();
        $parties = $this->parties($current_user->id)->get();

        return view('parties.index', ['parties' => $parties]);
    }

    public function show(Party $party)
    {
        $current_user = Auth::user();

        $characters = PartyMember::where('party_id', $party->id)
            ->with('character')
            ->get()
            ->map(function ($partyMember) {
                return $partyMember->character;
            });

        return view(
            'parties.show',
            [
                'party' => $party,
                'characters' => $characters,
                'current_user_id' => $current_user->id,
            ]
        );
    }

    public function store()
    {
        $current_user = Auth::user();
        $faker = Faker\Factory::create();

        $party = $current_user->parties()->create([
            'name' => $faker->name().'\'s Heroes',
            'join_code' => Str::random(),
        ]);

        return redirect(route('parties.show', $party->id));
    }

    /*
     * Select parties which belong to the current user, or
     * have a character belonging to the current user.
     *
     * SELECT parties.*
     * FROM parties p
     * LEFT JOIN party_members pm ON pm.party_id = p.id
     * LEFT JOIN characters c ON c.id = pm.character_id
     * WHERE (
     *          c.user_id = <current_user_id>
     *       OR p.user_id = <current_user_id>
     * )
     * GROUP BY p.id
     */
    private function parties(int $user_id)
    {
        return DB::table('parties')
            ->selectRaw('parties.*, count(characters.id) as size')
            ->leftJoin('party_members', 'parties.id', '=', 'party_members.party_id')
            ->leftJoin('characters', 'party_members.character_id', '=', 'characters.id')
            ->where(function ($query) use ($user_id) {
                $query
                    ->where('parties.user_id', $user_id)
                    ->orWhere('characters.user_id', $user_id);
            })
            ->groupBy('parties.id');

    }
}
