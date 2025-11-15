<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorantProfile extends Model
{
    protected $fillable = [
        'cin',
        'cne',
        'nom_arabe',
        'prenom_arabe',
        'genre',
        'date_naissance',
        'situation_familiale',
        'situation_administrative',
        'orcid',
        'telephone',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
