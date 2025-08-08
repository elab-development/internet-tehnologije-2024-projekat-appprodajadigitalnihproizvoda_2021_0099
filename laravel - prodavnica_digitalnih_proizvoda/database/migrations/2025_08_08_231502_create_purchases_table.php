<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('purchases', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('recipe_id')->constrained()->cascadeOnDelete();
            $t->unsignedSmallInteger('downloads_left')->default(5); // po želji
            $t->timestamp('expires_at')->nullable();                 // po želji (npr. +1 godina)
            $t->timestamps();
            $t->unique(['user_id','recipe_id']); // jedan kupac -> jedno pravo po receptu
        });
    }

    public function down(): void {
        Schema::dropIfExists('purchases');
    }
};
