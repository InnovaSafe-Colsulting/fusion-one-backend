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
        Schema::create('recipe_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the recipe item');
            $table->foreignId('recipe_id')->constrained('recipes')->cascadeOnDelete()->comment('Recipe the ingredient belongs to');
            $table->foreignId('ingredient_id')->constrained('ingredients')->comment('Ingredient used in the recipe');
            $table->decimal('quantity', 12, 4)->comment('Quantity of ingredient used');
            $table->string('unit', 30)->comment('Unit used for the ingredient quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_items');
    }
};
