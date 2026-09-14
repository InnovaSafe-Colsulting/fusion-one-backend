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
        Schema::create('modules', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the module');
            $table->string('name', 100)->comment('Visible name of the module in FusionOne');
            $table->string('slug', 100)->unique()->comment('Unique text identifier for the module, typically used for routes or internal references');
            $table->text('description')->nullable()->comment('Description of the module');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the module is available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
