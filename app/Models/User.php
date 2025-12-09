<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relation avec le profil du doctorant
     */
    public function doctorantProfile()
    {
        return $this->hasOne(DoctorantProfile::class);
    }

    /**
     * Relation with the current thesis (These).
     *
     * Some controllers expect a `these` relation on the User model.
     */
    public function these()
    {
        return $this->hasOne(These::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prenom',
        'nom_fr',
        'nom_ar',
        'prenom_ar',
        'cin',
        'cne',
        'genre',
        'date_naissance',
        'situation_familiale',
        'situation_administrative',
        'telephone',
        'orcid',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
