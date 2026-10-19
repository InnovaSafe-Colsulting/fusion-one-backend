<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['permission_id']);
            $table->dropUnique('role_permissions_unique');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreignId('module_id')->nullable()->constrained('modules')->nullOnDelete()->comment('Module the permission applies to');
            $table->unique(['role_id', 'permission_id', 'module_id'], 'role_permissions_unique');
        });
    }

    public function down(): void
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropUnique('role_permissions_unique');
            $table->dropForeign(['module_id']);
            $table->dropColumn('module_id');
            $table->unique(['role_id', 'permission_id'], 'role_permissions_unique');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('module_id')->constrained('modules')->comment('Module the permission belongs to');
        });
    }
};
