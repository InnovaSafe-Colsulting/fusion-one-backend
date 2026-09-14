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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the relationship');
            $table->foreignId('user_id')->constrained('users')->comment('User the role is assigned to');
            $table->foreignId('role_id')->constrained('roles')->comment('Role assigned to the user');

            $table->unique(['user_id', 'role_id'], 'user_roles_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
