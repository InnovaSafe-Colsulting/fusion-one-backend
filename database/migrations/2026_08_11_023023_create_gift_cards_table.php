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
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the gift card');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the gift card');
            $table->string('code', 100)->comment('Unique gift card code');
            $table->decimal('initial_balance', 12, 2)->comment('Initial balance assigned to the card');
            $table->decimal('current_balance', 12, 2)->comment('Currently available balance');
            $table->date('expires_at')->nullable()->comment('Card expiration date');
            $table->string('status', 30)->comment('Current card status');

            $table->unique(['tenant_id', 'code'], 'gift_cards_tenant_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
