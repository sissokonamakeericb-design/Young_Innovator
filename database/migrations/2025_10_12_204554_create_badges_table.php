<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('nom');          // ex: "Expert Laravel"
            $table->string('description');  // ex: "Complété tous les quiz Laravel"
            $table->string('icone')->nullable(); // URL ou chemin de l’icône
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
