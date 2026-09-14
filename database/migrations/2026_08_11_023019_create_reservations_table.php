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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the reservation');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the reservation');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the reservation is made');
            $table->foreignId('customer_id')->constrained('customers')->comment('Customer making the reservation');
            $table->foreignId('table_id')->nullable()->constrained('restaurant_tables')->nullOnDelete()->comment('Reserved table');
            $table->unsignedBigInteger('reservation_number')->comment('Consecutive reservation number');
            $table->timestamp('reservation_date')->comment('Reserved date and time');
            $table->integer('guests')->comment('Number of guests in the reservation');
            $table->string('status', 30)->comment('Reservation status');
            $table->text('notes')->nullable()->comment('Reservation observations');

            $table->unique(['tenant_id', 'branch_id', 'reservation_number'], 'reservations_tenant_branch_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
