<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'categorie',
        'image',
        'enseignant_id'
    ];

 

    // Un cours appartient à un enseignant
    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }

    // Un cours peut avoir plusieurs étudiants
    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'cours_etudiants', 'cours_id', 'user_id')
                    ->withTimestamps();
    }

    // Un cours peut avoir plusieurs quiz
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
