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
        Schema::create('order_item_modifiers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the applied modifier');
            $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnDelete()->comment('Order item the modifier is applied to');
            $table->foreignId('modifier_option_id')->constrained('modifier_options')->comment('Selected modifier option');
            $table->decimal('quantity', 12, 4)->default(1)->comment('Number of times the option is applied');
            $table->decimal('price', 12, 2)->default(0)->comment('Price applied for the modifier option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_modifiers');
    }
};
