# 🎉 Application Laravel - Portail Doctoral

## ✅ Authentification Corrigée et Testée

Tous les problèmes d'authentification ont été résolus et testés avec succès !

### 🔧 Corrections Apportées

#### 1. **Middleware Guest Appliqué**

Les routes de login et Google OAuth sont maintenant protégées avec le middleware `guest:web`:

-   Les utilisateurs **authentifiés** qui essaient d'accéder à `/login` sont **redirigés automatiquement vers `/dashboard`**
-   Cela élimine le problème des "deux pages de login différentes"

#### 2. **Logout Sécurisé et Nettoyé**

```php
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('success', 'Déconnexion réussie');
})->name('logout')->middleware('auth');
```

#### 3. **Routes Protégées**

-   `/login` : Accessible uniquement aux utilisateurs NON authentifiés (middleware `guest:w`)
-   `/dashboard` : Accessible uniquement aux utilisateurs authentifiés (middleware `auth`)
-   `/logout` : POST uniquement, protégé par middleware `auth`
-   `/auth/google` : Redirige vers Google, protégé par middleware `guest:web`

---

## 🚀 Démarrage Rapide

### 1. Installation Initiale

```bash
# Cloner le projet
git clone <repository-url>
cd <project-directory>

# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install

# Copier le fichier .env
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Migrer la base de données
php artisan migrate

# Compiler les assets
npm run build
```

### 2. Configuration Google OAuth

Assurez-vous que votre fichier `.env` contient :

```env
GOOGLE_CLIENT_ID=votre_client_id
GOOGLE_CLIENT_SECRET=votre_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 3. Démarrage du Serveur

```bash
# Démarrer le serveur Laravel
php artisan serve

# Dans un autre terminal, optionnel - watch assets
npm run dev
```

Accédez à : **http://localhost:8000**

---

## 📊 Flux d'Authentification Complet

```
┌─────────────────────────────────────────────────────────────┐
│ UTILISATEUR NON AUTHENTIFIÉ                                 │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Accès à http://localhost:8000/                              │
│ Route: GET / → redirect('/login')                           │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Redirecté vers http://localhost:8000/login                  │
│ Middleware: guest:web (CHECK: utilisateur NON auth? OK)     │
│ Vue: resources/views/auth/login.blade.php                   │
└─────────────────────────────────────────────────────────────┘
          │
          ├─► PAGE DE LOGIN AFFICHÉE (UNE SEULE PAGE)         │
          │   - Colonne gauche: BLANCHE                       │
          │   - Colonne droite: GRADIENT BLEU (desktop)       │
          │   - Bouton: "Connexion avec Google"               │
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Clic: "Connexion avec Google"                               │
│ GET /auth/google                                            │
│ Controller: GoogleController@redirectToGoogle               │
│ Middleware: guest:web (CHECK: utilisateur NON auth? OK)     │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Redirigé vers Google OAuth                                  │
│ (Utilisateur connecté à Google)                             │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Google retourne le token et les infos utilisateur           │
│ GET /auth/google/callback                                   │
│ Controller: GoogleController@handleGoogleCallback           │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Vérifier si l'utilisateur existe dans la DB                 │
│ - Si EXISTS: Récupérer l'utilisateur                        │
│ - Si NOT EXISTS: Créer un nouvel utilisateur                │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Auth::login($user)                                          │
│ Session établie et persistée dans storage/framework/sessions│
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Redirigé vers redirect()->intended('dashboard')             │
│ RouteServiceProvider::HOME = '/dashboard'                   │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ GET /dashboard                                              │
│ Middleware: auth (CHECK: utilisateur auth? OUI)             │
│ Vue: resources/views/dashboard.blade.php                    │
│ STATUS: 🟢 UTILISATEUR CONNECTÉ                             │
└─────────────────────────────────────────────────────────────┘
          │
          ├─► SESSION PERSISTE
          │   Tant que l'utilisateur ne se déconnecte pas
          │   ou que la session ne expire pas (120 minutes)
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ UTILISATEUR AUTHENTIFIÉ SUR LE DASHBOARD                    │
│                                                             │
│ Tentative d'accès à /login manuellement:                    │
│ GET /login                                                  │
│ Middleware: guest:web (CHECK: utilisateur auth? OUI)        │
│ ACTION: REDIRIGE VERS /dashboard                            │
│ (RedirectIfAuthenticated middleware)                        │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Clic: "Déconnexion"                                         │
│ POST /logout                                                │
│ Middleware: auth (CHECK: utilisateur auth? OUI)             │
│ Controller: (closure dans routes/web.php)                   │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ Auth::logout()                                              │
│ session()->invalidate()                                     │
│ session()->regenerateToken()                                │
│ Redirection: /login avec message "Déconnexion réussie"      │
└─────────────────────────────────────────────────────────────┘
          │
          ↓
┌─────────────────────────────────────────────────────────────┐
│ GET /login                                                  │
│ Middleware: guest:web (CHECK: utilisateur NON auth? OUI)    │
│ Vue: resources/views/auth/login.blade.php                   │
│ STATUS: 🟢 PAGE DE LOGIN AFFICHÉE (MÊME PAGE QU'AU DÉBUT)   │
│                                                             │
│ ⚠️ PAS DE DIFFÉRENCE VISUELLE - C'EST LA MÊME PAGE!        │
└─────────────────────────────────────────────────────────────┘
```

---

## 🧪 Tests - Tous Passés ✅

```
✓ unauthenticated user can access login page
✓ root redirects to login
✓ authenticated user cannot access login page
✓ unauthenticated user cannot access dashboard
✓ authenticated user can access dashboard
✓ logout redirects to login
✓ session persists after login
✓ unauthenticated user cannot logout
✓ authenticated user cannot access google login
✓ login page has expected content

Tests: 10 passed
```

Exécuter les tests :

```bash
php artisan test tests/Feature/AuthenticationFlowTest.php
```

---

## 📁 Structure des Fichiers Clés

### Routes

```
routes/web.php
├── GET  /login              → view('auth.login')         [guest:web]
├── GET  /auth/google        → redirectToGoogle()         [guest:web]
├── GET  /auth/google/callback → handleGoogleCallback()   []
├── POST /logout             → logout()                   [auth]
├── GET  /dashboard          → view('dashboard')          [auth]
└── GET  /                   → redirect('/login')         []
```

### Views (Blade Templates)

```
resources/views/
├── auth/
│   └── login.blade.php          [LA PAGE DE LOGIN - UNE SEULE!]
├── layouts/
│   ├── auth.blade.php           [Layout pour login]
│   ├── dashboard.blade.php      [Layout pour dashboard]
│   └── app.blade.php            [Layout principal]
└── dashboard.blade.php
```

### Controllers

```
app/Http/Controllers/Auth/
└── GoogleController.php
    ├── redirectToGoogle()
    └── handleGoogleCallback()
```

### Middleware

```
app/Http/Middleware/
├── RedirectIfAuthenticated.php  [Redirige vers /dashboard si auth]
└── Authenticate.php             [Redirige vers /login si not auth]
```

### Configuration

```
config/
├── auth.php                 [Guard 'web' + session driver]
├── session.php              [Driver: 'file', Lifetime: 120]
└── services.php             [Google Socialite config]

.env
├── SESSION_DRIVER=file
├── SESSION_LIFETIME=120
├── GOOGLE_CLIENT_ID=...
├── GOOGLE_CLIENT_SECRET=...
└── GOOGLE_REDIRECT_URI=...
```

---

## 🔍 Dépannage

### Problème: "Deux pages de login différentes"

**Solution:** Middleware `guest:web` appliqué à `/login`

-   Les utilisateurs authentifiés sont automatiquement redirigés vers `/dashboard`
-   Il n'existe qu'UNE SEULE page de login: `resources/views/auth/login.blade.php`

### Problème: Logout ne fonctionne pas

**Solution:** Middleware `auth` appliqué à `/logout`

```php
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');
```

### Problème: Session expire trop vite

**Vérifier:** `config/session.php` → `'lifetime' => 120` (minutes)
**Augmenter si nécessaire:** Changer `SESSION_LIFETIME=120` dans `.env`

### Problème: CSS/JS ne charge pas

**Solution:** Vérifier que `npm run build` a été exécuté

```bash
npm install
npm run build
```

### Problème: Google OAuth ne fonctionne pas

**Vérifier:**

1. `GOOGLE_CLIENT_ID` configuré dans `.env`
2. `GOOGLE_CLIENT_SECRET` configuré dans `.env`
3. `GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback` dans `.env`
4. Google Console: URL de redirection autorisée = `http://localhost:8000/auth/google/callback`

---

## 📋 Checklist de Déploiement

-   [ ] Composer install
-   [ ] npm install
-   [ ] php artisan key:generate
-   [ ] .env configuré (Google OAuth, SESSION_DRIVER, etc.)
-   [ ] php artisan migrate
-   [ ] npm run build
-   [ ] Tests passent: `php artisan test`
-   [ ] Serveur démarre: `php artisan serve`
-   [ ] Accès à login: http://localhost:8000/login
-   [ ] Google OAuth fonctionne
-   [ ] Dashboard accessible après login
-   [ ] Logout fonctionne et redirige vers login
-   [ ] Session persiste après reload

---

## 🎯 Résumé

✅ **Flux d'authentification complètement corrigé et testé**
✅ **Middleware guest:web appliqué - élimine les "deux pages de login"**
✅ **Logout sécurisé avec session invalidation**
✅ **Tous les tests passent (10/10)**
✅ **Documentation complète**

**Vous êtes prêt à utiliser l'application!** 🚀
