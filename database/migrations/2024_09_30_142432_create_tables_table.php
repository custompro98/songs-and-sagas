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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('join_code')->unique();

            $table->timestamps();
        });

        Schema::create('table_parties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->foreignId('party_id')->references('id')->on('parties')->onDelete('cascade');

            $table->timestamps();

            $table->unique(['table_id']);
        });

        Schema::create('table_decks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->foreignId('deck_id')->references('id')->on('decks')->onDelete('cascade');

            $table->timestamps();

            $table->unique(['table_id']);
            $table->unique(['deck_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_decks');
        Schema::dropIfExists('table_parties');
        Schema::dropIfExists('tables');
    }
};
