<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('description')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->unique(['user_id', 'name']);
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deck_id')->references('id')->on('decks')->onDelete('cascade');

            $table->string('suit');
            $table->string('rank');

            $table->timestamp('discarded_at')->nullable();
            $table->foreignId('character_id')->nullable()->references('id')->on('characters')->onDelete('set null');

            $table->timestamps();

            $table->index('deck_id');
            $table->index('character_id');
            $table->unique(['deck_id', 'suit', 'rank']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
        Schema::dropIfExists('decks');
    }
};
