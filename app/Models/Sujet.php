<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    use HasFactory;

    protected $fillable = ['intitule_sujet', 'prof_id'];

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }
}
