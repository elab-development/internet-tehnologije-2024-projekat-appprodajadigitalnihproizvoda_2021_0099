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
    Schema::table('purchases', function (Blueprint $table) {
        $table->dropColumn(['downloads_left', 'expires_at']);
    });
}

public function down(): void
{
    Schema::table('purchases', function (Blueprint $table) {
        $table->unsignedSmallInteger('downloads_left')->default(5);
        $table->timestamp('expires_at')->nullable();
    });
}
};
