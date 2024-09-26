<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeckStoreRequest;
use App\Models\Deck;
use App\Popos\Card\Rank;
use App\Popos\Card\Suit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use Mauricius\LaravelHtmx\Http\HtmxRequest;

class DeckController extends Controller
{
    public function index(): View
    {
        $current_user = Auth::user();
        $decks = $current_user->decks()->get();

        return view('decks.index', ['decks' => $decks]);
    }

    public function show(Deck $deck): View
    {
        return view('decks.show', ['deck' => $deck]);
    }

    public function create(): View
    {
        return view('decks.create');
    }

    public function store(DeckStoreRequest $request): RedirectResponse
    {
        $current_user = Auth::user();

        $deck = $current_user->decks()->create($request->validated());

        $cards = [];
        foreach (Suit::cases() as $suit) {
            foreach (Rank::cases() as $rank) {
                $cards[] = [
                    'suit' => $suit->name,
                    'rank' => $rank->name,
                ];
            }
        }

        $deck->cards()->createManyQuietly($cards);

        return redirect(route('decks.show', $deck->id));
    }

    public function draw(HtmxRequest $request, string $id): string
    {
        if (! $request->isHtmxRequest()) {
            abort(404);
        }

        /** @var \App\Models\Deck $deck */
        $deck = Deck::findOrFail($id);
        $deck->draw();

        return FacadesView::renderFragment('decks.show', 'fragments.decks.show.discard_pile', ['deck' => $deck]);
    }
}
