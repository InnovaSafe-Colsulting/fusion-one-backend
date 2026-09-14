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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the invoice setting');
            $table->string('logo', 255)->nullable()->comment('Logo used on the invoice');
            $table->string('header', 255)->nullable()->comment('Header content or text of the invoice');
            $table->string('footer_invoice', 255)->nullable()->comment('Footer content or text of the invoice');
            $table->string('message_description', 255)->nullable()->comment('Additional message or description shown on the invoice');
            $table->text('terms_conditions')->nullable()->comment('Terms and conditions that may be displayed on the invoice');
            $table->boolean('show_taxes')->nullable()->comment('Indicates whether taxes are shown on the invoice');
            $table->boolean('show_tips')->nullable()->comment('Indicates whether tips are shown on the invoice');
            $table->boolean('show_conpany_info')->nullable()->comment('Indicates whether company information is shown on the invoice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};
