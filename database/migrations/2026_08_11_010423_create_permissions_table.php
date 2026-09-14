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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the permission');
            $table->foreignId('module_id')->constrained('modules')->comment('Module the permission belongs to');
            $table->string('action', 100)->comment('Allowed action, e.g. view, create, update or delete');
            $table->string('name', 150)->unique()->comment('Unique permission name');
            $table->text('description')->nullable()->comment('Description of what the permission allows');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the permission is available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
