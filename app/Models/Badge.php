<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'icone',
    ];

    public function etudiants()
    {
        return $this->belongsToMany(User::class, 'badges_etudiants')
                    ->withTimestamps();
    }
}
