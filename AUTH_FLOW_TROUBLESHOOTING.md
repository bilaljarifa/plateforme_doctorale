# Guide de Dépannage du Flux d'Authentification

## Résumé des Corrections Apportées

### 1. **Middleware Guest Appliqué aux Routes d'Authentification**

-   Route `/login` : Maintenant avec middleware `guest:web`
-   Route `/auth/google` : Maintenant avec middleware `guest:web`
-   Cela empêche les utilisateurs authentifiés d'accéder à la page de login

### 2. **Logout Protégé et Nettoyé**

-   Middleware `auth` appliqué à la route logout
-   Session invalidée et token régénéré
-   Redirection vers `/login` avec message de succès

### 3. **Flow d'Authentification Complet**

```
Utilisateur Non Authentifié
        ↓
    Accès à / (racine)
        ↓
    Redirigé vers /login (sans middleware)
        ↓
    Page de login affichée (1 seule page)
        ↓
    Clique "Connexion avec Google"
        ↓
    Redirigé vers auth/google (avec middleware guest)
        ↓
    Redirigé vers Google OAuth
        ↓
    Google retourne le user
        ↓
    Redirigé vers /auth/google/callback
        ↓
    User créé ou trouvé dans la DB
        ↓
    Auth::login($user) exécuté
        ↓
    Redirigé vers /dashboard (via RouteServiceProvider::HOME)
        ↓
    Session établie (persist dans la DB)

Utilisateur Authentifié sur le Dashboard
        ↓
    Clique sur "Déconnexion"
        ↓
    POST /logout (avec middleware auth)
        ↓
    Auth::logout() exécuté
        ↓
    Session::invalidate() exécuté
        ↓
    Session::regenerateToken() exécuté
        ↓
    Redirigé vers /login
        ↓
    Page de login affichée (LA MÊME page - pas de différence)
```

## Configuration Vérifiée

### ✅ `routes/web.php`

-   ✅ Login route avec middleware `guest:web`
-   ✅ Google routes avec middleware `guest:web`
-   ✅ Logout route avec middleware `auth`
-   ✅ Dashboard protégé par middleware `auth`

### ✅ `app/Providers/RouteServiceProvider.php`

-   ✅ HOME constant = '/dashboard'

### ✅ `app/Http/Middleware/Authenticate.php`

-   ✅ Redirige vers 'login' route

### ✅ `app/Http/Middleware/RedirectIfAuthenticated.php`

-   ✅ Redirige les utilisateurs authentifiés vers RouteServiceProvider::HOME (/dashboard)

### ✅ `config/auth.php`

-   ✅ Guard par défaut = 'web'
-   ✅ Driver = 'session'
-   ✅ Provider = 'eloquent' (User model)

### ✅ `config/session.php`

-   ✅ Driver = 'file'
-   ✅ Lifetime = 120 minutes

### ✅ `.env`

-   ✅ SESSION_DRIVER=file
-   ✅ SESSION_LIFETIME=120
-   ✅ GOOGLE_CLIENT_ID configuré
-   ✅ GOOGLE_CLIENT_SECRET configuré
-   ✅ GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

### ✅ `app/Models/User.php`

-   ✅ Champ 'google_id' dans fillable
-   ✅ Migration 2025_11_08_140000_add_google_id_to_users_table appliquée

### ✅ `config/services.php`

-   ✅ Configuration Google Socialite correcte

### ✅ Assets

-   ✅ Compilés avec Vite (npm run build)
-   ✅ public/build/manifest.json présent
-   ✅ CSS et JS chargés via @vite

## Testing du Flow

### Test 1: Accès Initial (Non Authentifié)

```
1. Ouvrir http://localhost:8000/
2. ATTENDU: Redirigé vers http://localhost:8000/login
3. ATTENDU: Page de login affichée avec 2 colonnes (blanc + dégradé bleu)
4. ATTENDU: Bouton "Connexion avec Google" visible
```

### Test 2: Login avec Google

```
1. Cliquer sur "Connexion avec Google"
2. ATTENDU: Redirigé vers Google OAuth
3. ATTENDU: Après accept, redirigé vers http://localhost:8000/dashboard
4. ATTENDU: Session établie, utilisateur connecté
```

### Test 3: Dashboard (Authentifié)

```
1. Sur http://localhost:8000/dashboard
2. ATTENDU: Page du dashboard affichée
3. ATTENDU: Bouton "Déconnexion" visible
```

### Test 4: Accès à Login Depuis Dashboard (Utilisateur Authentifié)

```
1. Depuis le dashboard, accéder manuellement à http://localhost:8000/login
2. ATTENDU: Redirigé AUTOMATIQUEMENT vers http://localhost:8000/dashboard
3. RAISON: Middleware 'guest' vérifie si utilisateur est authentifié et redirige vers HOME (/dashboard)
```

### Test 5: Logout

```
1. Sur le dashboard, cliquer sur "Déconnexion"
2. ATTENDU: POST /logout exécuté
3. ATTENDU: Session invalidée
4. ATTENDU: Redirigé vers http://localhost:8000/login
5. ATTENDU: Page de login affichée (MÊME page qu'au début)
6. ATTENDU: Aucune différence visuelle
```

### Test 6: Accès aux Routes Protégées (Non Authentifié)

```
1. Non authentifié
2. Accéder à http://localhost:8000/dashboard
3. ATTENDU: Redirigé vers http://localhost:8000/login
4. RAISON: Middleware 'auth' redirige vers login via Authenticate middleware
```

## Problèmes Potentiels et Solutions

### Problème 1: Deux pages de login différentes

**Cause Probable:**

-   Middleware 'guest' n'était pas appliqué à la route login
-   Utilisateurs authentifiés pouvaient accéder à /login
-   Affichage d'une page login avec CSS/layout différent

**Solution Appliquée:**

-   Ajout du middleware `guest:web` à la route /login
-   Middleware RedirectIfAuthenticated redirige automatiquement vers /dashboard

**Vérification:**

```bash
# Dans le code:
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware(['guest:web']);
```

### Problème 2: Logout ne redirige pas vers la login page

**Cause Probable:**

-   Route logout sans middleware auth
-   Session non invalidée correctement

**Solution Appliquée:**

-   Middleware `auth` ajouté à la route logout
-   session()->invalidate() exécuté
-   session()->regenerateToken() exécuté

**Vérification:**

```bash
# Dans le code:
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('success', 'Déconnexion réussie');
})->name('logout')->middleware('auth');
```

### Problème 3: Redirection après login

**Solution Appliquée:**

-   RouteServiceProvider::HOME = '/dashboard'
-   GoogleController utilise redirect()->intended('dashboard')

**Vérification:**

```bash
# Dans GoogleController::handleGoogleCallback():
Auth::login($user);
return redirect()->intended('dashboard');
```

### Problème 4: Session ne persiste pas

**Vérification:**

-   SESSION_DRIVER=file dans .env
-   SESSION_LIFETIME=120
-   session middleware dans config/http.php

**Vérifier la structure des dossiers:**

```bash
storage/framework/sessions/  # Doit exister
```

## Commandes de Maintenance

### Vider le cache de session

```bash
php artisan cache:clear
php artisan view:clear
php artisan config:cache
```

### Migrer les modifications de base de données

```bash
php artisan migrate
```

### Vérifier les routes

```bash
php artisan route:list | grep -E '(login|logout|auth|google|dashboard)'
```

### Reconstruire les assets

```bash
npm install
npm run build
```

## Fichiers Modifiés

1. ✅ `routes/web.php` - Ajout middleware guest:web et auth
2. ✅ `public/build/assets/*` - Reconstruits avec Vite

## Fichiers Vérifiés (Aucune Modification Nécessaire)

1. ✅ `app/Http/Middleware/RedirectIfAuthenticated.php`
2. ✅ `app/Http/Middleware/Authenticate.php`
3. ✅ `app/Providers/RouteServiceProvider.php`
4. ✅ `config/auth.php`
5. ✅ `config/session.php`
6. ✅ `config/services.php`
7. ✅ `app/Models/User.php`
8. ✅ `app/Http/Controllers/Auth/GoogleController.php`
9. ✅ `resources/views/auth/login.blade.php`
10. ✅ `resources/views/layouts/auth.blade.php`

## Résumé

-   **Une seule page de login** : resources/views/auth/login.blade.php
-   **Même apparence après login et logout** : Même view, même layout
-   **Middleware guest:web** : Empêche les utilisateurs authentifiés d'accéder à /login
-   **Middleware auth** : Protège /logout et /dashboard
-   **Session persiste** : Jusqu'à logout ou expiration (120 minutes)

🎉 **Tout problème de "deux pages de login différentes" doit maintenant être résolu !**
