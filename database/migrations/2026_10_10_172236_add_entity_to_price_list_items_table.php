<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('price_list_items', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable()
                ->comment('ID of the related entity (customer, table, channel, etc.)')
                ->after('price_list_id');
            $table->string('entity_type', 100)->nullable()
                ->comment('Morph class of the related entity')
                ->after('entity_id');

            $table->index(['entity_id', 'entity_type'], 'price_list_items_entity_index');
        });
    }

    public function down(): void
    {
        Schema::table('price_list_items', function (Blueprint $table) {
            $table->dropIndex('price_list_items_entity_index');
            $table->dropColumn(['entity_id', 'entity_type']);
        });
    }
};
