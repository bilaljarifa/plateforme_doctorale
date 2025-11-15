<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class These extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'apogee',
        'centre_etudes_doctorales_id',
        'formations_doctorales_id',
        'directeur_these_id',
        'laboratoire_id',
        'etablissement_id',
        'sujet_id',
        'co_directeur_type',
        'co_directeur_nom_complet',
        'co_directeur_nom',
        'co_directeur_prenom',
        'co_directeur_etablissement',
        'annee_inscription',
        'annee_premiere_inscription',
        'date_prevue_soutenance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ced()
    {
        return $this->belongsTo(Ced::class, 'centre_etudes_doctorales_id');
    }
    public function ped()
    {
        return $this->belongsTo(Ped::class, 'formations_doctorales_id');
    }
    public function directeur()
    {
        return $this->belongsTo(Prof::class, 'directeur_these_id');
    }
    public function laboratoire()
    {
        return $this->belongsTo(Laboratoire::class);
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }
    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }
}
