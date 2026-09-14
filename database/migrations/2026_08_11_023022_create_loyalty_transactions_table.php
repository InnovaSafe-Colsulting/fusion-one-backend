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
        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the points transaction');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the transaction');
            $table->foreignId('customer_id')->constrained('customers')->comment('Customer affected by the transaction');
            $table->string('type', 30)->comment('Points operation type, e.g. accumulation or redemption');
            $table->integer('points')->comment('Number of points generated or used');
            $table->string('reference_type', 100)->nullable()->comment('Type of entity that originated the transaction');
            $table->unsignedBigInteger('reference_id')->nullable()->comment('Identifier of the record that originated the transaction');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_transactions');
    }
};
