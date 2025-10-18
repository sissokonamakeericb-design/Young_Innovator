<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'options',
        'reponse_correcte',
        'quiz_id'
    ];

    protected $casts = [
        'options' => 'array', // permet de stocker les options comme tableau
    ];

    // RELATION
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
