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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the supplier');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the supplier');
            $table->string('document_type', 30)->nullable()->comment('Supplier document type');
            $table->string('document_number', 50)->nullable()->comment('Supplier document number');
            $table->string('name', 150)->comment('Supplier name or company name');
            $table->string('email', 150)->nullable()->comment('Supplier email address');
            $table->string('phone', 50)->nullable()->comment('Supplier phone number');
            $table->string('address', 255)->nullable()->comment('Supplier address');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the supplier is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'document_type', 'document_number'], 'suppliers_tenant_document_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
