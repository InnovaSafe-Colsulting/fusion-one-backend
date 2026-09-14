<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mfa_codes', function (Blueprint $table) {
            $table->string('email')->nullable()->after('user_id');
            $table->boolean('used')->default(false)->after('code');
            $table->dropColumn(['channel', 'used_at']);
        });
    }

    public function down(): void
    {
        Schema::table('mfa_codes', function (Blueprint $table) {
            $table->dropColumn(['email', 'used']);
            $table->enum('channel', ['email', 'whatsapp'])->after('code');
            $table->timestamp('used_at')->nullable();
        });
    }
};
