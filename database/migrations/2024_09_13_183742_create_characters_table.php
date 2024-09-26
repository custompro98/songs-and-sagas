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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('pronouns');
            $table->string('vanori');

            $table->integer('str');
            $table->integer('dex');
            $table->integer('wil');
            $table->integer('hrt');

            $table->integer('resilience_current');
            $table->integer('resilience_max');
            $table->integer('experience');

            $table->integer('armor');

            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('character_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->references('id')->on('characters')->onDelete('cascade');
            $table->string('note');

            $table->timestamps();

            $table->index('character_id');
        });

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->references('id')->on('characters')->onDelete('cascade');

            $table->timestamps();

            $table->index('character_id');
        });

        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('note')->nullable();
            $table->integer('quantity')->default(0);

            $table->timestamps();

            $table->index('inventory_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('characters');
        Schema::dropIfExists('character_notes');
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('inventory_items');
    }
};
