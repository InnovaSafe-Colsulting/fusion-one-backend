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
        Schema::create('modifier_options', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the modifier option');
            $table->foreignId('modifier_id')->constrained('modifiers')->cascadeOnDelete()->comment('Modifier the option belongs to');
            $table->string('name', 100)->comment('Option name');
            $table->decimal('price', 12, 2)->default(0)->comment('Additional cost of selecting this option');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the option is available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifier_options');
    }
};
