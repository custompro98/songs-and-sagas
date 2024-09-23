<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterNoteController;
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
    Route::resource('characters', CharacterController::class)->except(['create', 'store', 'edit']);

    // Character Notes
    Route::resource('characters.notes', CharacterNoteController::class)->only(['store', 'destroy'])->shallow();

    // Inventory Items
    Route::resource('characters.inventory_items', InventoryItemController::class)->only(['update'])->shallow();

    /*
     * Party Routes
     */

    // Parties
    Route::resource('parties', PartyController::class)->only(['index', 'store', 'show']);

    // Party Members
    Route::resource('party_members', PartyMemberController::class)->only(['store']);
});

require __DIR__.'/auth.php';
