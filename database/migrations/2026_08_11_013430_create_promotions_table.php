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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the promotion');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the promotion');
            $table->string('name', 150)->comment('Promotion name');
            $table->text('description')->nullable()->comment('Promotion description');
            $table->string('type', 30)->comment('Promotion type');
            $table->decimal('value', 12, 2)->comment('Value used by the promotion');
            $table->timestamp('starts_at')->nullable()->comment('Date and time the promotion starts');
            $table->timestamp('ends_at')->nullable()->comment('Date and time the promotion ends');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the promotion is active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
