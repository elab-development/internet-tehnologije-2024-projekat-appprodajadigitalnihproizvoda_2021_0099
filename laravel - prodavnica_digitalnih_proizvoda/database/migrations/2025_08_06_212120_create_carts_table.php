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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Korisnik kojem pripada korpa
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Recept koji je dodat u korpu
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            
            // Količina, ako je relevantno (npr. više kupovina istog recepta)
            $table->unsignedInteger('quantity')->default(1);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
