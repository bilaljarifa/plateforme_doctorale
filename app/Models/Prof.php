<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prof extends Model
{
    use HasFactory;

    protected $fillable = ['nom_fr', 'prenom', 'email', 'laboratoire_id'];

    public function laboratoire()
    {
        return $this->belongsTo(Laboratoire::class);
    }

    public function sujets()
    {
        return $this->hasMany(Sujet::class);
    }
}
