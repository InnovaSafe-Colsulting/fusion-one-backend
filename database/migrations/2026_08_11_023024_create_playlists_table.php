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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the playlist');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the playlist');
            $table->string('name', 150)->comment('Playlist name');
            $table->text('description')->nullable()->comment('Playlist description');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the playlist is active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};
