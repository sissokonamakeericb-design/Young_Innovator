<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnseignantRequest extends Model
{
    use HasFactory;

    // Nom de la table (facultatif si Laravel suit la convention)
    protected $table = 'enseignant_requests';

    // Colonnes qui peuvent être assignées en masse (mass assignable)
    protected $fillable = [
        'user_id',
        'specialite',
        'niveau_etude',
        'description',
        'cv',
        'status',
    ];

    /**
     * Relation avec l'utilisateur (étudiant qui fait la demande)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
