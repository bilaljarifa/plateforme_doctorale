<?php

use App\Models\User;
use App\Models\DoctorantProfile;
use App\Models\These;

// Assuming user ID 1 or the first user. 
// A better way would be to check all users or the one logging in, but let's check the first one as a proxy if we don't know the exact ID.
$user = User::first();

if (!$user) {
    echo "No users found.\n";
    exit;
}

echo "User ID: " . $user->id . "\n";
echo "Name: " . $user->name . "\n";
echo "Email: " . $user->email . "\n";

// Check DoctorantProfile
$profile = $user->doctorantProfile;
if ($profile) {
    echo "DoctorantProfile FOUND (ID: " . $profile->id . ")\n";
    echo "  - CIN: " . ($profile->cin ?? 'NULL') . "\n";
    echo "  - NOM ARABE: " . ($profile->nom_arabe ?? 'NULL') . "\n";
    echo "  - PRENOM ARABE: " . ($profile->prenom_arabe ?? 'NULL') . "\n";
} else {
    echo "DoctorantProfile NOT FOUND.\n";
}

// Check These
$these = $user->these;
if ($these) {
    echo "These FOUND (ID: " . $these->id . ")\n";
    echo "  - Sujet: " . ($these->sujet_these ?? 'NULL') . "\n";
} else {
    echo "These NOT FOUND.\n";
}
