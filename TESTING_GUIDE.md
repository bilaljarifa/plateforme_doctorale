# 🧪 Guide de Test - Design Professionnel

## 📌 Avant de Commencer

Assurez-vous que vous avez exécuté:

```bash
npm run build
```

Ensuite, videz le cache navigateur (Ctrl+Shift+Delete).

---

## 🎯 Checklist de Test

### 1. Page de Connexion (`/login`)

**Éléments à vérifier:**

-   [ ] Page affiche correctement
-   [ ] Logo université visible (bleu)
-   [ ] Texte "Connexion" en français
-   [ ] Bouton "Se connecter avec Google"
-   [ ] Design cohérent blanc/bleu
-   [ ] Responsive sur mobile (test avec F12)
-   [ ] Footer visible en bas
-   [ ] Pas d'erreurs console (F12)

**Test Mobile:**

-   [ ] Layout s'adapte (< 768px)
-   [ ] Texte lisible
-   [ ] Boutons cliquables

---

### 2. Dashboard (`/dashboard`) - Après Connexion

**Éléments à vérifier:**

-   [ ] Navbar visible en haut (fixé)
-   [ ] Logo + titre "Université Ibn Tofail"
-   [ ] Liens nav: Dashboard, Articles, Thèse
-   [ ] Dropdown profil avec nom utilisateur
-   [ ] Bouton Déconnexion accessible
-   [ ] Selector langue (FR/AR/EN) visible
-   [ ] Sidebar gauche avec navigation
-   [ ] Contenu main aligné à droite
-   [ ] Footer visible en bas
-   [ ] Background gradient subtil

**Test Responsive:**

-   [ ] Menu hamburger sur mobile (< 768px)
-   [ ] Sidebar se masque sur mobile
-   [ ] Contenu utilise full width

---

### 3. Navbar - Interactions

**À tester:**

-   [ ] Clic sur logo → Redirection home
-   [ ] Clic "Dashboard" → Active state (highlight)
-   [ ] Clic "Articles" → Navigation correcte
-   [ ] Clic "Thèse" → Navigation correcte
-   [ ] Hover sur liens → Transition fluide
-   [ ] Dropdown profil clique → Ouvre menu
-   [ ] Logout button → Déconnexion propre
-   [ ] Language selector → Change langue (FR/AR/EN)
-   [ ] Hover sur items → Couleur change

**Test Mobile:**

-   [ ] Hamburger menu visible
-   [ ] Clic hamburger → Menu s'ouvre
-   [ ] Clic item → Navigation et fermeture
-   [ ] Close button → Referme menu

---

### 4. Footer - Contenu

**Vérifier présence:**

-   [ ] Section "À Propos"
    -   [ ] Description université
    -   [ ] Texte informatif
-   [ ] Section "Liens Rapides"
    -   [ ] Dashboard
    -   [ ] Articles
    -   [ ] Thèse
-   [ ] Section "Contact"
    -   [ ] Adresse université
    -   [ ] Email support
    -   [ ] Numéro téléphone
    -   [ ] Icônes appropriées
-   [ ] Section "Réseaux Sociaux"
    -   [ ] Facebook
    -   [ ] Twitter
    -   [ ] LinkedIn
    -   [ ] Instagram
    -   [ ] Icônes visibles

**Footer Bottom:**

-   [ ] Copyright année: 2025
-   [ ] Lien Politique Confidentialité
-   [ ] Lien Conditions d'Utilisation
-   [ ] Responsive: centered sur mobile

---

### 5. Couleurs - Cohérence

**Vérifier palette (blanc & bleu):**

-   [ ] Navbar: Bleu gradient (#0066cc → #004499)
-   [ ] Boutons: Bleu #0066cc
-   [ ] Boutons hover: Bleu foncé #004499
-   [ ] Accents: Bleu clair #e6f2ff
-   [ ] Fond: Blanc #ffffff ou gris clair #f8f9fa
-   [ ] Texte: Gris foncé #1f2937
-   [ ] Pas de couleurs en conflit
-   [ ] Progression de teintes cohérente

**Test sur:**

-   [ ] Page connexion
-   [ ] Dashboard
-   [ ] Articles
-   [ ] Toutes les pages

---

### 6. Responsive Design

**Desktop (≥1024px):**

-   [ ] Layout normal
-   [ ] Sidebar visible
-   [ ] Contenu full width
-   [ ] Navbar normal

**Tablet (768px - 1023px):**

-   [ ] Sidebar toujours visible
-   [ ] Contenu ajusté
-   [ ] Navbar adapté

**Mobile (<768px):**

-   [ ] Hamburger menu visible
-   [ ] Sidebar disparaît
-   [ ] Full width contenu
-   [ ] Navbar responsive
-   [ ] Footer une colonne

**Test sur DevTools (F12):**

-   [ ] iPhone 12 (390x844)
-   [ ] iPad (768x1024)
-   [ ] Desktop (1920x1080)

---

### 7. Formulaires (s'il y en a)

**Vérifier style:**

-   [ ] Inputs avec bordure bleu au focus
-   [ ] Labels en gris foncé
-   [ ] Background blanc
-   [ ] Placeholder texte gris
-   [ ] Bouton submit bleu
-   [ ] Bouton hover bleu foncé
-   [ ] Validation messages en rouge

**Test:**

-   [ ] Remplir formulaire
-   [ ] Erreurs affichent correctement
-   [ ] Coloration des erreurs

---

### 8. Articles (`/articles`)

**Éléments à vérifier:**

-   [ ] Navbar présente
-   [ ] Titre "Articles" stylisé
-   [ ] Cartes/Tableaux présents
-   [ ] Couleurs cohérentes
-   [ ] Footer présente
-   [ ] Responsive OK

---

### 9. Thèse (`/these`)

**Éléments à vérifier:**

-   [ ] Navbar présente
-   [ ] Titre "Thèse" stylisé
-   [ ] Contenu affiche
-   [ ] Design professionnel
-   [ ] Footer présente

---

### 10. Déconnexion

**Test logout:**

-   [ ] Clic logout → Redirection login
-   [ ] Page login affiche
-   [ ] Session limpiée (F12 Application/Cookies)
-   [ ] CSRF token régénéré
-   [ ] Message "Déconnexion réussie"
-   [ ] Impossible accéder /dashboard sans login

---

## 🔍 Tests de Performance

### Bundle Size

```
CSS: 33.93 kB (gzip: 6.02 kB)      ✅ OK
JS:  187.98 kB (gzip: 61.85 kB)    ✅ OK
```

-   [ ] Page charge en < 2 secondes
-   [ ] Pas de Layout Shift (LCP)
-   [ ] Animations fluides (60 FPS)

---

## ♿ Tests d'Accessibilité

-   [ ] Tous les liens ont title/aria-label
-   [ ] Contraste texte >= 4.5:1
-   [ ] Images alt text
-   [ ] Form labels associés
-   [ ] Keyboard navigation (Tab key)
-   [ ] Color not only conveyed by color
-   [ ] Focus visible sur tous les éléments

**Browser DevTools:**

-   [ ] Lighthouse score >= 90
-   [ ] No console errors/warnings

---

## 🌐 Tests Cross-Browser

### Chrome/Edge

-   [ ] Navbar OK
-   [ ] Footer OK
-   [ ] Animations OK
-   [ ] Responsive OK

### Firefox

-   [ ] Navbar OK
-   [ ] Footer OK
-   [ ] Bootstrap icons OK
-   [ ] Responsive OK

### Safari

-   [ ] Navbar OK
-   [ ] Footer OK
-   [ ] Dropdown OK
-   [ ] Mobile OK

### Mobile (Real Device)

-   [ ] iPhone Safari OK
-   [ ] Android Chrome OK
-   [ ] Touch interactions OK

---

## 📝 Éléments à Documenter

### Lors des Tests:

1. **Screenshots:**

    - Desktop version
    - Tablet version
    - Mobile version

2. **URLs Testées:**

    - /login
    - /dashboard
    - /articles
    - /these
    - /logout

3. **Navigateurs Testés:**

    - Chrome (version)
    - Firefox (version)
    - Safari (version)

4. **Appareils Testés:**
    - Desktop resolution
    - Mobile model
    - Tablet model

---

## 🐛 Bugs Potentiels à Chercher

-   [ ] Navbar overlaps content
-   [ ] Footer not at bottom
-   [ ] Couleurs ne match pas les specs
-   [ ] Responsive breaks at certain sizes
-   [ ] Icons don't display
-   [ ] Dropdown menu clipped
-   [ ] Form inputs misaligned
-   [ ] Links don't work
-   [ ] Session/Auth issues
-   [ ] Console errors/warnings

---

## ✅ Rapport Final

**Date Test:** ******\_\_\_******

**Testeur:** ******\_\_\_******

**Navigateurs Testés:**

-   [ ] Chrome **_version_**
-   [ ] Firefox **_version_**
-   [ ] Safari **_version_**

**Appareils Testés:**

-   [ ] Desktop
-   [ ] Tablet
-   [ ] Mobile

**Résultats:**

-   [ ] Navbar: ✅ OK / ⚠️ ISSUE
-   [ ] Footer: ✅ OK / ⚠️ ISSUE
-   [ ] Couleurs: ✅ OK / ⚠️ ISSUE
-   [ ] Responsive: ✅ OK / ⚠️ ISSUE
-   [ ] Performance: ✅ OK / ⚠️ ISSUE
-   [ ] Accessibility: ✅ OK / ⚠️ ISSUE

**Issues Trouvées:** (le cas échéant)

```
1. ...
2. ...
3. ...
```

**Notes Générales:**

```
...
```

**Recommandations:**

```
...
```

**Statut GLOBAL:**

-   [ ] ✅ PASS - Prêt pour production
-   [ ] ⚠️ PARTIAL - Issues mineures
-   [ ] ❌ FAIL - Issues majeures

---

## 🎯 Checklist Finale

Avant de déployer:

-   [ ] Tous les tests passent
-   [ ] Pas d'erreurs console
-   [ ] Responsive fonctionne
-   [ ] Performance OK
-   [ ] Accessibilité OK
-   [ ] Cross-browser OK
-   [ ] Screenshots documentés
-   [ ] Issues résolues
-   [ ] Documentation mise à jour
-   [ ] Build optimisé (npm run build)

---

## 📚 Ressources

**Pour tester:**

-   DevTools: F12
-   Lighthouse: F12 → Lighthouse
-   Responsive: F12 → Toggle device toolbar (Ctrl+Shift+M)
-   Performance: F12 → Performance tab

---

**Bon testing! 🚀**
