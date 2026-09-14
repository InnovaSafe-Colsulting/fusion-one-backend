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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the currency');
            $table->string('code', 3)->unique()->comment('International currency code, e.g. COP, USD or EUR');
            $table->string('name', 100)->comment('Currency name');
            $table->string('symbol', 10)->nullable()->comment('Currency symbol, e.g. $');
            $table->integer('decimal_places')->default(2)->comment('Number of decimal places used by the currency');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the currency is available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
