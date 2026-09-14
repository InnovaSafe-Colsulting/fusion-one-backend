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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the audit record');
            $table->unsignedBigInteger('tenant_id')->nullable()->comment('Tenant the audited action belongs to');
            $table->unsignedBigInteger('user_id')->nullable()->comment('User who performed the action');
            $table->string('action', 100)->comment('Action performed, e.g. create, update or delete');
            $table->string('entity_type', 100)->nullable()->comment('Type of entity the action was performed on');
            $table->unsignedBigInteger('entity_id')->nullable()->comment('Identifier of the affected record');
            $table->text('old_values')->nullable()->comment('Values before the change');
            $table->text('new_values')->nullable()->comment('Values after the change');
            $table->string('ip_address', 45)->nullable()->comment('IP address from which the action was performed');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
