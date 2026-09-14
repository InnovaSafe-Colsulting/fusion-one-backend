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
        Schema::create('cash_sessions', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the cash session or shift');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the session');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the cash register operates');
            $table->foreignId('cash_register_id')->constrained('cash_registers')->comment('Cash register used during the session');
            $table->foreignId('user_id')->constrained('users')->comment('User responsible for the cash session');
            $table->decimal('opening_amount', 12, 2)->default(0)->comment('Money available at the time of opening');
            $table->decimal('expected_amount', 12, 2)->nullable()->comment('Value the system expects to find at closing');
            $table->decimal('actual_amount', 12, 2)->nullable()->comment('Value actually found during the cash count');
            $table->decimal('difference', 12, 2)->nullable()->comment('Difference between the expected and actual value');
            $table->timestamp('opened_at')->nullable()->comment('Date and time of opening');
            $table->timestamp('closed_at')->nullable()->comment('Date and time of closing');
            $table->string('status', 30)->comment('Cash session status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_sessions');
    }
};
