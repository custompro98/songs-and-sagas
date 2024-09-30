<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartyRequest;
use App\Models\Party;
use App\Models\PartyMember;
use App\Models\TableParty;
use Faker;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartyController extends Controller
{
    public function index(): View
    {
        $current_user = Auth::user();
        $parties = $this->parties($current_user->id)->get();

        return view('parties.index', ['parties' => $parties]);
    }

    public function show(Party $party): View
    {
        $current_user = Auth::user();

        $characters = PartyMember::where('party_id', $party->id)
            ->with('character')
            ->get()
            ->map(function ($partyMember) {
                return $partyMember->character;
            })
            ->filter(function ($character) {
                return ! is_null($character);
            });

        $tables = TableParty::where('party_id', $party->id)
            ->with('table')
            ->get()
            ->map(function ($tableParty) {
                return $tableParty->table;
            })
            ->filter(function ($table) {
                return ! is_null($table);
            });

        return view(
            'parties.show',
            [
                'party' => $party,
                'characters' => $characters,
                'current_user_id' => $current_user->id,
                'tables' => $tables,
            ]
        );
    }

    public function create(): View
    {
        $current_user = Auth::user();

        return view('parties.create', ['current_user' => $current_user]);
    }

    public function store(StorePartyRequest $request): RedirectResponse
    {
        $current_user = Auth::user();
        $party = $current_user->parties()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'join_code' => Str::random(),
        ]);

        return redirect()->route('parties.show', $party->id);
    }

    public function generate(): RedirectResponse
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
    private function parties(int $user_id): Builder
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
