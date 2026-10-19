<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('ALTER TABLE price_list_items DROP FOREIGN KEY price_list_items_price_list_id_foreign');
        DB::statement('ALTER TABLE price_list_items DROP INDEX price_list_items_unique');
        DB::statement('ALTER TABLE price_list_items DROP INDEX price_list_items_product_id_foreign');
        Schema::table('price_list_items', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->foreign('price_list_id')->references('id')->on('price_lists')->cascadeOnDelete();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        Schema::table('price_list_items', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products');
            $table->unique(['price_list_id', 'product_id'], 'price_list_items_unique');
        });
    }
};
