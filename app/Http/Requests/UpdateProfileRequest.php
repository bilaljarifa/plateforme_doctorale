<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // L'utilisateur peut toujours mettre à jour son propre profil
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'prenom_ar' => 'required|string|max:255',
            'cin' => 'required|string|max:20',
            'cne' => 'required|string|max:20',
            'genre' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'situation_familiale' => 'required|string|max:50',
            'situation_administrative' => 'required|string|max:50',
            'telephone' => 'required|string|max:20',
            'orcid' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nom_fr.required' => 'Le nom en français est requis',
            'nom_ar.required' => 'Le nom en arabe est requis',
            'prenom.required' => 'Le prénom est requis',
            'prenom_ar.required' => 'Le prénom en arabe est requis',
            'cin.required' => 'Le CIN est requis',
            'cne.required' => 'Le CNE est requis',
            'genre.required' => 'Le genre est requis',
            'genre.in' => 'Le genre doit être soit masculin (M) soit féminin (F)',
            'date_naissance.required' => 'La date de naissance est requise',
            'date_naissance.date' => 'La date de naissance doit être une date valide',
            'situation_familiale.required' => 'La situation familiale est requise',
            'situation_administrative.required' => 'La situation administrative est requise',
            'telephone.required' => 'Le numéro de téléphone est requis',
        ];
    }
}
