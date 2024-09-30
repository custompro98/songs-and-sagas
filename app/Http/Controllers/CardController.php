<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardSendToHandRequest;
use App\Models\Card;
use Illuminate\Http\RedirectResponse;

class CardController extends Controller
{
    public function send(CardSendToHandRequest $request, Card $card): RedirectResponse
    {
        $card->update(['character_id' => $request->validated('character_id'), 'discarded_at' => null]);

        return back();
    }

    public function discard(Card $card): RedirectResponse
    {
        $card->discard();

        return back();
    }
}
