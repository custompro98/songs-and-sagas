<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterNoteController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PartyMemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'characters');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    /*
     * Character Routes
     */

    // Characters
    Route::post('/characters/generate', [CharacterController::class, 'generate'])->name('characters.generate');
    Route::resource('characters', CharacterController::class)->except(['edit']);

    // Character Notes
    Route::resource('characters.notes', CharacterNoteController::class)->only(['store', 'update', 'destroy'])->shallow();

    // Inventory Items
    Route::resource('characters.inventory_items', InventoryItemController::class)->only(['update'])->shallow();

    /*
     * Party Routes
     */

    // Parties
    Route::post('/parties/generate', [PartyController::class, 'generate'])->name('parties.generate');
    Route::resource('parties', PartyController::class)->except(['edit', 'update', 'destroy']);

    // Party Members
    Route::resource('party_members', PartyMemberController::class)->only(['store']);

    /*
     * Tools Routes
     */

    // Decks
    Route::post('/decks/{deck}/draw', [DeckController::class, 'draw'])->name('decks.draw');
    Route::post('/decks/{deck}/recall', [DeckController::class, 'recall'])->name('decks.recall');
    Route::post('/decks/{deck}/shuffle', [DeckController::class, 'shuffle'])->name('decks.shuffle');
    Route::resource('decks', DeckController::class)->only(['index', 'show', 'create', 'store']);

    // Cards
    Route::patch('/cards/{card}/send', [CardController::class, 'send'])->name('cards.send');
    Route::patch('/cards/{card}/discard', [CardController::class, 'discard'])->name('cards.discard');
});

require __DIR__.'/auth.php';
