<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the currency rate');
            $table->foreignId('currency_id')->constrained('currencies')->cascadeOnDelete()->comment('Reference to the currency');
            $table->decimal('rate', 15, 6)->comment('Exchange rate between the two currencies');
            $table->string('value_from_currency', 3)->comment('Currency code to convert from, e.g. USD');
            $table->string('value_to_currency', 3)->comment('Currency code to convert to, e.g. COP');
            $table->boolean('is_active')->default(true)->comment('Indicates whether this rate is active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
