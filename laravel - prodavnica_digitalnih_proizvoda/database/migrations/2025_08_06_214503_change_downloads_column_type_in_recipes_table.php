<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('downloads')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->bigInteger('downloads')->default(0)->change();
        });
    }
};
