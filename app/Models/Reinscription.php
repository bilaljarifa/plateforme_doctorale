<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reinscription extends Model
{
    protected $fillable = [
        'user_id',
        'annee_academique',
        'taux_avancement',
        'rapport_activite',
        'thesis_progress',
        'derniere_publication',
        'annee_inscription',
        'rapport_path',
        'directeur_valide',
        'receipt_pdf_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
