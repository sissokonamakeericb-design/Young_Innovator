<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'cours_id',
        'enseignant_id'
    ];

 

    // Un quiz appartient à un cours
    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }

    // Un quiz appartient à un enseignant
    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    // Un quiz a plusieurs questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Un quiz peut être fait par plusieurs étudiants
    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'progressions', 'quiz_id', 'user_id')
                    ->withPivot('score', 'completed_at')
                    ->withTimestamps();
    }
}
