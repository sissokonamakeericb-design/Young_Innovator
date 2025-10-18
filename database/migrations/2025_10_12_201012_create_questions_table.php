<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');                // Le texte de la question
            $table->json('options');                 // Les options possibles sous forme de JSON
            $table->string('reponse_correcte');      // La bonne réponse
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
