<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterNoteController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show');
    Route::post('/characters/generate', [CharacterController::class, 'generate'])->name('characters.generate');
    Route::patch('/characters/{id}', [CharacterController::class, 'update'])->name('characters.update');
    Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])->name('characters.destroy');

    Route::post('/characters/{characterId}/notes', [CharacterNoteController::class, 'store'])->name('characters.notes.store');
    Route::delete('/characters/{characterId}/notes/{noteId}', [CharacterNoteController::class, 'destroy'])->name('characters.notes.destroy');

    Route::patch('/inventory_items/{id}', [InventoryItemController::class, 'update'])->name('inventory_items.update');

    Route::get('/parties', [PartyController::class, 'index'])->name('parties.index');
});

require __DIR__.'/auth.php';
