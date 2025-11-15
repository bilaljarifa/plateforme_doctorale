<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratoire extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'etablissement_id'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function profs()
    {
        return $this->hasMany(Prof::class);
    }
}
