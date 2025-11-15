<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ped extends Model
{
    use HasFactory;

    protected $fillable = ['intitule'];

    public function ceds()
    {
        return $this->hasMany(Ced::class);
    }
}
