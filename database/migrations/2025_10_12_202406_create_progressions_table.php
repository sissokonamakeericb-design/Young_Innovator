<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // étudiant
            $table->foreignId('cours_id')->constrained('cours')->onDelete('cascade');
            $table->integer('points')->default(0);      // points obtenus
            $table->integer('quizzes_termine')->default(0); // nombre de quiz terminés
            $table->timestamps();
            
            $table->unique(['user_id', 'cours_id']); // un étudiant par cours
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progressions');
    }
};
