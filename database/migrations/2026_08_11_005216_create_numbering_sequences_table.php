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
        Schema::create('numbering_sequences', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the numbering sequence');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the numbering sequence');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->comment('Branch the sequence applies to; null if it applies to the entire tenant');
            $table->string('document_type', 50)->comment('Document type that uses this sequence');
            $table->string('prefix', 20)->nullable()->comment('Prefix used in the document numbering');
            $table->string('resolution_number', 100)->nullable()->comment('Resolution number associated with the sequence');
            $table->unsignedBigInteger('start_number')->nullable()->comment('First authorized number in the sequence');
            $table->unsignedBigInteger('end_number')->nullable()->comment('Last authorized number in the sequence');
            $table->unsignedBigInteger('current_number')->default(0)->comment('Last number currently used');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the sequence is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'branch_id', 'document_type', 'prefix'], 'numbering_sequences_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numbering_sequences');
    }
};
