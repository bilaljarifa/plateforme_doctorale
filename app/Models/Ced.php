<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ced extends Model
{
    use HasFactory;

    protected $fillable = ['intitule', 'ped_id'];

    public function ped()
    {
        return $this->belongsTo(Ped::class);
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class);
    }
}
