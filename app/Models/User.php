<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Champs modifiables en masse
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'password',
        'photo_profil',
        'role',
        'points_totaux',
        'etat_compte',
        'bio',
    ];

    // Champs cachés (ne seront pas renvoyés dans les réponses JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Conversion automatique des dates
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   

    // Un utilisateur peut avoir plusieurs cours (si enseignant)
    public function cours()
    {
        return $this->hasMany(Cours::class, 'enseignant_id');
    }

    // Un utilisateur peut créer plusieurs quiz
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'enseignant_id');
    }

    // Un étudiant peut avoir plusieurs progressions
    public function progressions()
    {
        return $this->hasMany(Progression::class);
    }

    // Relation badges pour un étudiant
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'badges_etudiants', 'user_id', 'badge_id')
                    ->withTimestamps();
    }

    // Relation cours suivis par l'étudiant
    public function coursSuivis()
    {
        return $this->belongsToMany(Cours::class, 'cours_etudiants', 'user_id', 'cours_id')
                    ->withTimestamps();
    }

    public function coursInscrits()
{
    return $this->belongsToMany(Cours::class, 'cours_etudiants')
                ->withTimestamps();
}

}
