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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('description')->nullable();

            $table->string('join_code')->unique();

            $table->timestamps();
        });

        Schema::create('party_members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('party_id')->references('id')->on('parties')->onDelete('cascade');
            $table->foreignId('character_id')->references('id')->on('characters')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_members');
        Schema::dropIfExists('parties');
    }
};
