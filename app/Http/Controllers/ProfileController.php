<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update($request->validated());

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }
}
