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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable()->comment('Main companys name inside of FusionOne');
            $table->string('commercial_name', 255)->nullable()->comment('commercial name of the company');
            $table->string('legal_name', 255)->nullable()->comment('social reason or companys legal name');
            $table->string('email', 100)->nullable()->unique()->comment('Main companies email');
            $table->string('phone', 10)->nullable()->comment('Main companies phone');
            $table->string('address', 100)->nullable()->comment('Main companies address');
            $table->string('neighboarhood', 155)->nullable()->comment('Main Address neighboardhood');

            $table->foreignId('city_id')->constrained('cities')->comment('city of the company');

            $table->string('logo')->nullable()->comment('Path or locations logo');
            $table->enum('status', [1, 0])->default(1)->comment('tenant status inside FusionOne');
            $table->string('timezone')->default('America/Bogotá')->comment('Timezone tenats used');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
