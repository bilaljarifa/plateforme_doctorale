# 🔧 Guide d'Intégration du Design Professionnel

## Comment Utiliser le Nouveau Design

### 1️⃣ Utiliser les Layouts

#### Pour les Pages Publiques/Auth

```blade
@extends('layouts.app')

@section('content')
    <!-- Votre contenu ici -->
@endsection
```

**Inclut automatiquement:**

-   ✅ Navbar professionnel top
-   ✅ Footer professionnel bottom
-   ✅ CSS professionnel
-   ✅ Bootstrap Icons
-   ✅ Bootstrap JS

---

#### Pour les Pages Dashboard

```blade
@extends('layouts.dashboard')

@section('content')
    <!-- Votre contenu ici -->
@endsection
```

**Inclut automatiquement:**

-   ✅ Navbar professionnel top
-   ✅ Sidebar navigation gauche
-   ✅ Footer professionnel bottom
-   ✅ All CSS/JS
-   ✅ Livewire & PowerGrid support

---

### 2️⃣ Composants Disponibles

#### Navbar

```blade
@include('components.navbar')
```

**Automatiquement dans les layouts, mais peut être réutilisé**

#### Footer

```blade
@include('components.footer')
```

**Automatiquement dans les layouts, mais peut être réutilisé**

---

### 3️⃣ Classes CSS Professionnelles

#### Boutons

```blade
<!-- Bouton Primaire (Bleu) -->
<button class="btn btn-primary">Envoyer</button>

<!-- Bouton Secondaire (Blanc/Bleu) -->
<button class="btn btn-secondary">Annuler</button>

<!-- Bouton Outline -->
<button class="btn btn-outline-primary">Outline</button>
```

#### Cards

```blade
<div class="dashboard-card">
    <h5>Titre</h5>
    <p>Contenu</p>
</div>
```

**Styles:** Border bleu gauche, ombre légère, hover effect

#### Boîtes Statistiques

```blade
<div class="stat-box">
    <div class="number">42</div>
    <div class="label">Articles</div>
</div>
```

#### Titles

```blade
<h1 class="page-title">Mon Titre</h1>
```

**Styles:** Bleu primaire, underline bleu, spacing

#### Tableaux

```blade
<table class="table">
    <thead>
        <tr>
            <th>Colonne 1</th>
            <th>Colonne 2</th>
        </tr>
    </thead>
    <tbody>
        <!-- données -->
    </tbody>
</table>
```

**Styles:** Header bleu, hover rows, responsive

---

### 4️⃣ Variables CSS Disponibles

```css
var(--primary-blue)       /* #0066cc */
var(--primary-blue-dark)  /* #004499 */
var(--primary-blue-light) /* #e6f2ff */
var(--white)              /* #ffffff */
var(--gray-light)         /* #f8f9fa */
var(--text-color)         /* #1f2937 */
var(--shadow-light)       /* Légère ombre */
var(--shadow-medium)      /* Ombre moyenne */
var(--shadow-hover)       /* Ombre au hover */
```

**Utilisation:**

```css
.my-element {
    background: var(--primary-blue);
    color: var(--white);
    box-shadow: var(--shadow-light);
}
```

---

### 5️⃣ Icônes Bootstrap

**Disponibles:** 1000+ icônes

```blade
<i class="bi bi-house"></i>
<i class="bi bi-person"></i>
<i class="bi bi-document"></i>
<i class="bi bi-gear"></i>
<i class="bi bi-trash"></i>
<i class="bi bi-pencil"></i>
<i class="bi bi-check"></i>
<i class="bi bi-x"></i>
```

**Tailles:**

```blade
<i class="bi bi-house"></i>              <!-- Default 1em -->
<i class="bi bi-house" style="font-size: 2rem;"></i>
<i class="bi bi-house" style="font-size: 1.5rem;"></i>
```

---

### 6️⃣ Responsive Design

**Breakpoints:**

```css
Mobile (< 768px)  - Menu hamburger
Tablet (≥ 768px)  - Layout normal
Desktop (≥ 1024px) - Full width
```

**Classes Responsive:**

```blade
<!-- Afficher seulement sur desktop -->
<div class="d-none d-md-block">Desktop Only</div>

<!-- Afficher seulement sur mobile -->
<div class="d-md-none">Mobile Only</div>

<!-- Grille responsive -->
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">Contenu</div>
</div>
```

---

### 7️⃣ Formulaires Professionnels

```blade
<form method="POST" action="{{ route('submit') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
```

---

### 8️⃣ Alertes et Notifications

```blade
<!-- Success -->
<div class="alert alert-success alert-dismissible fade show" role="alert">
    ✓ {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<!-- Error -->
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    ✗ Une erreur s'est produite
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<!-- Warning -->
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    ⚠ Attention
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<!-- Info -->
<div class="alert alert-info alert-dismissible fade show" role="alert">
    ℹ Information
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

---

### 9️⃣ Modals

```blade
<!-- Bouton Trigger -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Ouvrir Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Titre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Contenu ici
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Confirmer</button>
            </div>
        </div>
    </div>
</div>
```

---

### 🔟 Exemples Complets

#### Page Simple

```blade
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="page-title">Ma Page</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <h5>Contenu Principal</h5>
                    <p>Texte de démonstration...</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="stat-box">
                    <div class="number">100</div>
                    <div class="label">Utilisateurs</div>
                </div>
            </div>
        </div>
    </div>
@endsection
```

#### Dashboard Page

```blade
@extends('layouts.dashboard')

@section('content')
    <h1 class="page-title">Dashboard</h1>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="stat-box">
                <div class="number">{{ $articles }}</div>
                <div class="label">Articles</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-box">
                <div class="number">{{ $users }}</div>
                <div class="label">Utilisateurs</div>
            </div>
        </div>
    </div>

    <div class="dashboard-card mt-4">
        <h5>Derniers Articles</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author }}</td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
```

---

## ✅ Checklist d'Intégration

-   [ ] Layout configuré (@extends)
-   [ ] Navbar affichée correctement
-   [ ] Footer visible en bas
-   [ ] Couleurs consistent bleu/blanc
-   [ ] Responsive testé (mobile)
-   [ ] Buttons stylisés
-   [ ] Tables formatées
-   [ ] Forms professionnelles
-   [ ] Aucune erreur console
-   [ ] Texte lisible (contrast)

---

## 🎨 Customization

### Changer les Couleurs Primaires

Éditer `resources/css/professional.css`, ligne ~4:

```css
:root {
    --primary-blue: #0066cc; /* Changer ici */
    --primary-blue-dark: #004499; /* Et ici */
    --primary-blue-light: #e6f2ff; /* Et ici */
    /* ... reste des variables ... */
}
```

Puis recompiler:

```bash
npm run build
```

### Ajouter des Styles Personnalisés

1. Ouvrir `resources/css/professional.css`
2. Ajouter vos styles à la fin
3. Recompiler: `npm run build`

---

## 🆘 Troubleshooting

**Styles n'apparaissent pas?**

-   Vérifier: `npm run build` a-t-il été exécuté?
-   Vérifier: Layout utilise `@extends('layouts.app')`?
-   Vérifier: Cache navigateur (Ctrl+Shift+Del)

**Navbar n'apparaît pas?**

-   Vérifier: `@include('components.navbar')` est dans le layout
-   Vérifier: Fichier navbar.blade.php existe

**Footer manquant?**

-   Vérifier: `@include('components.footer')` est dans le layout
-   Vérifier: Fichier footer.blade.php existe

**Icônes manquantes?**

-   Vérifier: CDN Bootstrap Icons est chargé
-   Vérifier: Syntaxe: `<i class="bi bi-iconname"></i>`

---

## 📚 Ressources

-   **Bootstrap 5 Docs:** https://getbootstrap.com/docs/5.0/
-   **Bootstrap Icons:** https://icons.getbootstrap.com/
-   **Tailwind CSS:** https://tailwindcss.com/docs
-   **Vite:** https://vitejs.dev/

---

**Dernière mise à jour:** {{ date('Y-m-d') }}
