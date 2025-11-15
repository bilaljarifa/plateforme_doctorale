<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DoctorantProfile;

class UserProfile extends Component
{
    // Propriété utilisateur
    public $user;

    // Propriétés de base de l'utilisateur
    public $nom_fr;
    public $prenom_fr;
    public $email;

    // Propriétés du profil
    public $cin;
    public $cne;
    public $nom_arabe;
    public $prenom_arabe;
    public $genre;
    public $date_naissance;
    public $situation_familiale;
    public $situation_administrative;
    public $orcid;
    public $telephone;

    public function mount()
    {
        $this->user = auth()->user();
        $profile = $this->user->doctorantProfile ?? new DoctorantProfile();

        // Initialiser les propriétés de l'utilisateur
        $this->nom_fr = $this->user->name;
        $this->prenom_fr = $this->user->prenom ?? '';
        $this->email = $this->user->email;

        // Initialiser les propriétés du profil
        $this->cin = $profile->cin;
        $this->cne = $profile->cne;
        $this->nom_arabe = $profile->nom_arabe;
        $this->prenom_arabe = $profile->prenom_arabe;
        $this->genre = $profile->genre;
        $this->date_naissance = $profile->date_naissance;
        $this->situation_familiale = $profile->situation_familiale;
        $this->situation_administrative = $profile->situation_administrative;
        $this->orcid = $profile->orcid;
        $this->telephone = $profile->telephone;
    }

    public function save()
    {
        $this->validate([
            'nom_fr' => 'required|string|max:255',
            'prenom_fr' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'cin' => 'nullable|string|max:20',
            'cne' => 'nullable|string|max:20',
            'nom_arabe' => 'nullable|string|max:255',
            'prenom_arabe' => 'nullable|string|max:255',
            'genre' => 'nullable|in:Homme,Femme',
            'date_naissance' => 'nullable|date',
            'situation_familiale' => 'nullable|in:Célibataire,Marié(e),Divorcé(e),Veuf(ve)',
            'situation_administrative' => 'nullable|in:Fonctionnaire,Salarié,Sans emploi',
            'orcid' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Mettre à jour l'utilisateur
        $user = auth()->user();
        $user->update([
            'name' => $this->nom_fr,
            'prenom' => $this->prenom_fr,
            'email' => $this->email,
        ]);

        // Mettre à jour le user en cache
        $this->user = $user;

        // Mettre à jour ou créer le profil
        $user->doctorantProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'cin' => $this->cin,
                'cne' => $this->cne,
                'nom_arabe' => $this->nom_arabe,
                'prenom_arabe' => $this->prenom_arabe,
                'genre' => $this->genre,
                'date_naissance' => $this->date_naissance,
                'situation_familiale' => $this->situation_familiale,
                'situation_administrative' => $this->situation_administrative,
                'orcid' => $this->orcid,
                'telephone' => $this->telephone,
            ]
        );

        session()->flash('success', 'Profil mis à jour avec succès');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
