# 🎨 Guide Visuel - Design Professionnel

## 🎯 Aperçu Visuel du Design

### Palette de Couleurs

```
┌─────────────────────────────────────────────────────────┐
│                    COULEURS PRIMAIRES                   │
├─────────────────────────────────────────────────────────┤
│                                                           │
│  Bleu Primaire         Bleu Foncé         Bleu Clair   │
│  #0066cc              #004499             #e6f2ff     │
│  ██████ (boutons)     ██████ (hover)      ██████ (bg) │
│                                                           │
│  Blanc                Gris Clair          Gris Texte   │
│  #ffffff              #f8f9fa             #1f2937     │
│  ██████ (contenu)     ██████ (bg)         ██████ (text)│
│                                                           │
└─────────────────────────────────────────────────────────┘
```

---

## 📱 Navbar - Composant Principal

### Desktop (≥1024px)

```
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ [UIT Logo]  PhD-MS  │ Dashboard  Articles  Thèse    ┃
┃                                    [👤 User ▼] [FR▼] ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
  ↑ Bleu Gradient (#0066cc → #004499)
  • Fixed top
  • Ombre douce
  • Hauteur 64px
```

### Mobile (<768px)

```
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ [≡] PhD-MS      [👤] [FR▼]  ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
  Menu Hamburger Collapsible
```

### Dropdown Profile

```
  [👤 John Doe ▼]
        ↓
  ┌──────────────────┐
  │ Dashboard        │
  │ Articles         │
  │ Thèse           │
  │ ─────────────── │
  │ 🚪 Déconnexion  │
  └──────────────────┘
```

---

## 📄 Footer - Structure

```
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃                   FOOTER PROFESSIONNELS                ┃
├─────────┬─────────┬──────────┬──────────────────────────┤
│         │         │          │                          │
│ À Propos│ Liens  │ Contact  │ Réseaux Sociaux         │
│         │        │          │                          │
│ Universi│Dashboard│📍Kénitra │ 📘 📧 📼 🎥            │
│té Ibn   │Articles │📧support │ Suivez nous             │
│ Tofail  │Thèse   │📞+212(0) │                         │
│ Portal  │        │          │                          │
│ pour    │        │          │                          │
│études   │        │          │                          │
│doctora  │        │          │                          │
│les      │        │          │                          │
│         │        │          │                          │
├─────────┴─────────┴──────────┴──────────────────────────┤
│  © 2025 Université Ibn Tofail | Privacy | Terms        │
└────────────────────────────────────────────────────────┛
  ↑ Bleu Gradient (#0052a3 → #0066cc)
```

---

## 🎴 Dashboard Layout

```
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ [≡] PhD-MS  │ Dashboard  Articles  Thèse [👤▼] [FR▼] ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛

┌─────────────────┐ ┌────────────────────────────────────┐
│   SIDEBAR       │ │         MAIN CONTENT               │
│ ────────────── │ │ ─────────────────────────────────┐ │
│                 │ │ 📊 Dashboard                     │ │
│ 👤 Profil      │ │                                   │ │
│ 📖 Thèse       │ │ ┌─ Stat Box ──────────────────┐  │ │
│ 📝 Articles    │ │ │ 42 │  Articles              │  │ │
│ 💬 Comm.       │ │ └────────────────────────────┘  │ │
│ 🔄 Rein.       │ │                                   │ │
│                 │ │ ┌─────────────────────────────┐  │ │
│ ───────────── │ │ │ Card: Derniers Articles    │  │ │
│ 🚪 Logout     │ │ │ ─────────────────────────┐ │  │ │
│                 │ │ │ • Article 1   - Author 1│ │  │ │
│                 │ │ │ • Article 2   - Author 2│ │  │ │
│                 │ │ │ • Article 3   - Author 3│ │  │ │
│                 │ │ └─────────────────────────┘ │  │ │
│                 │ └─────────────────────────────────┘ │
│                 │                                     │
└─────────────────┴────────────────────────────────────┘

┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃ © 2025 Université Ibn Tofail | Footer Information     ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
```

---

## 🎨 Composants Visuels

### Card avec Border Bleu

```
┌─────────────────────────────┐
│ ◼ Titre Card                │
│ ────────────────────────── │
│                             │
│ Contenu de la card ...      │
│ avec texte et autres ...    │
│                             │
└─────────────────────────────┘
↑ Border-left bleu, ombre légère
  Hover: elevation ↑, shadow augmente
```

### Boîte Statistique

```
    ┌────────────────────┐
    │                    │
    │       42           │  ← Nombre en bleu gros
    │                    │
    │    Articles        │  ← Label en bleu foncé
    │                    │
    └────────────────────┘
    Background: Bleu clair #e6f2ff
    Radius: 10px
```

### Boutons

#### Primaire (Bleu)

```
    ┌──────────────┐
    │ ✓ Envoyer   │  Bleu #0066cc
    └──────────────┘
       Hover: Bleu foncé + Ombre
```

#### Secondaire

```
    ┌──────────────┐
    │ ✗ Annuler   │  Blanc/Gris
    └──────────────┘
       Hover: Gris clair
```

### Formulaire

```
Email
┌──────────────────────────┐
│ vous@exemple.com         │  Focus: Border bleu
└──────────────────────────┘

Message
┌──────────────────────────┐
│ Écrivez votre message ... │
│                          │
│                          │
└──────────────────────────┘

        [✓ Envoyer]  ← Bouton bleu
```

---

## 📊 Tableau Professionnel

```
┌────────────────────────────────────────────────────────┐
│ Titre                │ Auteur           │ Date        │  ← Header bleu
├────────────────────────────────────────────────────────┤
│ Article 1            │ Professeur Smith │ 15/01/2025  │  Hover: bg clair
│ Article 2            │ Dr. Johnson      │ 14/01/2025  │
│ Article 3            │ Prof. Williams   │ 13/01/2025  │
├────────────────────────────────────────────────────────┤
│ Montrant 3/42 | [Prev] [1] [2] [Next]                │  Footer: blanc
└────────────────────────────────────────────────────────┘
```

---

## 📱 Mobile Layout (< 768px)

### Navbar Collapsé

```
┌─────────────────────────┐
│ [≡] PhD-MS  👤  FR▼    │
└─────────────────────────┘
```

### Menu Hamburger

```
[≡] clic →
    ┌────────────┐
    │ Dashboard  │
    │ Articles   │
    │ Thèse     │
    │ Logout    │
    └────────────┘
```

### Dashboard Mobile

```
┌─────────────────────┐
│  Navbar             │
├─────────────────────┤
│ Sidebar Sidebar     │
│ Stack vertically    │
│ ────────────────── │
│ Content             │
│ Full width          │
│ ────────────────── │
│ Footer              │
│ Une colonne         │
└─────────────────────┘
```

---

## 🌈 Thème de Couleur en Détail

### Bleu Primaire (#0066cc)

**Utilisé pour:**

-   Navbar background
-   Boutons primaires
-   Accents
-   Links hover
-   Border-left cards

**Hex:** #0066cc
**RGB:** 0, 102, 204
**HSL:** 210°, 100%, 40%

### Bleu Foncé (#004499)

**Utilisé pour:**

-   Navbar gradient bottom
-   Boutons hover
-   Active states
-   Text dark

**Hex:** #004499
**RGB:** 0, 68, 153
**HSL:** 210°, 100%, 30%

### Bleu Clair (#e6f2ff)

**Utilisé pour:**

-   Card backgrounds
-   Stat box backgrounds
-   Highlight backgrounds
-   Subtle accents

**Hex:** #e6f2ff
**RGB:** 230, 242, 255
**HSL:** 210°, 100%, 95%

### Blanc (#ffffff)

**Utilisé pour:**

-   Text on blue
-   Card backgrounds
-   Form inputs
-   Footer text

**Hex:** #ffffff
**RGB:** 255, 255, 255

### Gris Clair (#f8f9fa)

**Utilisé pour:**

-   Page backgrounds
-   Input backgrounds
-   Table headers
-   Subtle divisions

**Hex:** #f8f9fa
**RGB:** 248, 249, 250

---

## 🎭 États des Éléments

### Liens

```
État Normal:   couleur bleu clair
État Hover:    couleur bleu foncé + underline
État Active:   couleur bleu foncé + border-bottom
État Visitd:   couleur bleu moyen
```

### Boutons

```
État Normal:    fond bleu, texte blanc, sans ombre
État Hover:     fond bleu foncé, texte blanc, ombre légère
État Active:    fond bleu très foncé, texte blanc, ombre
État Disabled:  fond gris, texte gris clair, pas ombre
```

### Inputs

```
État Normal:    border gris, bg blanc
État Focus:     border bleu, bg blanc, ombre bleu clair
État Error:     border rouge, bg blanc, msg rouge
État Disabled:  border gris clair, bg gris très clair
```

---

## 📐 Espacements & Tailles

### Typography

```
Titres: 24-32px, bold
Subtitles: 18-20px, semi-bold
Body: 14-16px, regular
Small: 12-14px, regular
```

### Spacing (Grid 8px)

```
xs: 4px   (micro)
sm: 8px   (small)
md: 16px  (medium)
lg: 24px  (large)
xl: 32px  (x-large)
2xl: 48px (2x-large)
```

### Radius

```
Cards: 10px
Buttons: 6px
Inputs: 6px
Modals: 12px
```

### Shadows

```
Light:   0 2px 10px rgba(0,102,204,0.1)
Medium:  0 5px 20px rgba(0,102,204,0.15)
Hover:   0 10px 30px rgba(0,102,204,0.2)
```

---

## ✨ Animations & Transitions

### Transitions

```
Normal:    200ms ease
Slow:      300ms ease
Fast:      100ms ease-in-out
```

### Effets

-   **Hover:** Light up (0.2s)
-   **Click:** Press down (0.1s)
-   **Load:** Fade in (0.3s)
-   **Cards:** Lift up (0.3s)

---

## 📏 Responsive Breakpoints

```
Mobile:   < 768px     (Portrait phone)
Tablet:   768px-1023px (Landscape phone, portrait tablet)
Desktop:  ≥ 1024px    (Desktop & landscape tablet)
Widescreen: ≥ 1440px  (Large monitors)
```

---

## ✅ Checklist Visuelle

-   [x] Couleurs blanc & bleu partout
-   [x] Navbar professionnel en top
-   [x] Footer 4-colonnes en bas
-   [x] Cards avec border bleu
-   [x] Boutons bleu cohérents
-   [x] Icônes Bootstrap visibles
-   [x] Responsive sur mobile
-   [x] Shadows & elevations
-   [x] Animations fluides
-   [x] Spacing consistent

---

**Design visuellement cohérent et professionnel! ✨**
