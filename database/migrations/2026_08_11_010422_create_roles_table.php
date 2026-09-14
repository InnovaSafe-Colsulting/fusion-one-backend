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
        Schema::create('roles', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the role');
            $table->unsignedBigInteger('tenant_id')->nullable()->comment('Tenant the role belongs to; null for global roles');
            $table->string('name', 100)->comment('Role name');
            $table->string('slug', 100)->comment('Text identifier for the role');
            $table->text('description')->nullable()->comment('Description of the responsibilities or purpose of the role');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the role is active');

            $table->unique(['tenant_id', 'slug'], 'roles_tenant_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
