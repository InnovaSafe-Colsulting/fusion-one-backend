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
        Schema::create('combo_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the combo item');
            $table->foreignId('combo_id')->constrained('combos')->cascadeOnDelete()->comment('Combo the product belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Product included in the combo');
            $table->decimal('quantity', 12, 4)->default(1)->comment('Quantity of the product included in the combo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_items');
    }
};
