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
        Schema::create('music_requests', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the music request');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the request');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the request is made');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->comment('Customer making the request');
            $table->string('title', 200)->comment('Requested song title');
            $table->string('artist', 150)->nullable()->comment('Requested artist');
            $table->string('status', 30)->comment('Request status');
            $table->timestamp('requested_at')->nullable()->comment('Date and time the request was made');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_requests');
    }
};
