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
        Schema::create('playlist_tracks', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the track within the playlist');
            $table->foreignId('playlist_id')->constrained('playlists')->cascadeOnDelete()->comment('Playlist the track belongs to');
            $table->string('title', 200)->comment('Track title');
            $table->string('artist', 150)->nullable()->comment('Track artist');
            $table->string('external_id', 150)->nullable()->comment('Track identifier on an external platform');
            $table->integer('position')->nullable()->comment('Track position within the playlist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_tracks');
    }
};
