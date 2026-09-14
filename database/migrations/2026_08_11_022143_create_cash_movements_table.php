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
        Schema::create('cash_movements', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the cash movement');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the movement');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the movement is registered');
            $table->foreignId('cash_session_id')->constrained('cash_sessions')->comment('Cash session the movement belongs to');
            $table->foreignId('user_id')->constrained('users')->comment('User who performs the movement');
            $table->string('type', 30)->comment('Movement type, e.g. income or withdrawal');
            $table->decimal('amount', 12, 2)->comment('Movement value');
            $table->string('reason', 255)->nullable()->comment('Reason for the movement');
            $table->string('reference_type', 100)->nullable()->comment('Type of entity related to the movement');
            $table->unsignedBigInteger('reference_id')->nullable()->comment('Identifier of the related record');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_movements');
    }
};
