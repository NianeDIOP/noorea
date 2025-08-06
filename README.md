# 🌟 Noorea - L'expérience beauté multiculturelle

<p align="center">
  <img src="public/logo.png" alt="Noorea Logo" width="200">
</p>

<p align="center">
  <em>La boutique en ligne premium de cosmétiques et parfums multiculturels au Sénégal</em>
</p>

## ✨ À propos de Noorea

Noorea est une boutique en ligne premium qui célèbre la diversité des traditions de beauté à travers le monde. Notre plateforme met l'accent sur une expérience utilisateur exceptionnelle avec un design luxueux et des transitions élégantes.

### 🎯 Notre Mission
- Devenir la plateforme e-commerce N°1 au Sénégal dans l'univers de la beauté
- Offrir une expérience utilisateur immersive et luxueuse  
- Promouvoir la diversité culturelle à travers les rituels de beauté
- Valoriser les marques africaines tout en proposant une sélection internationale premium

## 🛍️ Catalogue Produits

### Catégories principales
- **Soins visage** (35%) : Nettoyants, sérums, crèmes, masques
- **Maquillage** (30%) : Teint, yeux, lèvres adaptés aux peaux noires et métissées
- **Parfums** (20%) : Collections exclusives et fragrances inspirées d'Afrique
- **Soins capillaires** (10%) : Produits pour cheveux crépus, frisés et bouclés
- **Bien-être** (5%) : Bougies, huiles de massage, compléments beauté

### Répartition des marques
- **Marques africaines** : 40% (focus sur le Sénégal et l'Afrique de l'Ouest)
- **Marques européennes** : 25% (luxe et alternatives éthiques)
- **Marques coréennes** : 20% (K-Beauty sélectionnée)
- **Marques américaines** : 15% (marques inclusives)

## 🎨 Design & UX/UI

### Palette de couleurs
- **Blanc cassé** : `#F8F5F1` (couleur principale de fond)
- **Or rose** : `#E0BFB8` (accents féminins)
- **Vert émeraude** : `#1D6F58` (CTA et éléments importants)
- **Or** : `#D4AF37` (détails premium et animations)

### Typographie
- **Titres** : Playfair Display (élégant, serif)
- **Corps de texte** : Montserrat (moderne, sans-serif)

### Fonctionnalités UX
- Design mobile-first et responsive
- Animations et transitions fluides
- Micro-interactions élégantes
- Chargement optimisé avec lazy loading
- Navigation intuitive avec breadcrumbs

## 🚀 Technologies

### Stack technique
- **Framework** : Laravel 12
- **Front-end** : Blade + TailwindCSS + CSS personnalisé
- **Base de données** : MySQL (via XAMPP)
- **Assets** : Vite pour la compilation
- **Icons** : Font Awesome 6
- **Animations** : CSS3 + JavaScript vanilla

### Prérequis
- PHP 8.3+
- Composer
- Node.js & NPM
- XAMPP (Apache, MySQL)
- Git

## 📦 Installation

### 1. Cloner le projet
```bash
git clone https://github.com/votre-username/noorea.git
cd noorea
```

### 2. Installer les dépendances
```bash
# Dépendances PHP
composer install

# Dépendances JavaScript
npm install
```

### 3. Configuration de l'environnement
```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé de l'application
php artisan key:generate
```

### 4. Configuration de la base de données
1. Créer une base de données `noorea` dans phpMyAdmin
2. Configurer le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=noorea
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Exécuter les migrations
```bash
php artisan migrate
```

### 6. Compiler les assets
```bash
# Mode développement
npm run dev

# Mode production
npm run build
```

### 7. Démarrer le serveur
```bash
php artisan serve
```

Votre application sera accessible sur `http://localhost:8000`

## 📁 Structure du projet

```
noorea/
├── app/
│   ├── Http/Controllers/    # Contrôleurs
│   ├── Models/             # Modèles Eloquent
│   └── Providers/          # Service providers
├── database/
│   ├── migrations/         # Migrations de BDD
│   ├── seeders/           # Seeders pour données de test
│   └── factories/         # Factories pour modèles
├── resources/
│   ├── css/
│   │   ├── app.css        # Styles Tailwind
│   │   └── noorea.css     # Styles personnalisés
│   ├── js/                # Scripts JavaScript
│   └── views/             # Templates Blade
│       ├── layouts/       # Layouts principaux
│       ├── components/    # Composants réutilisables
│       └── pages/         # Pages spécifiques
├── routes/
│   └── web.php           # Routes de l'application
└── public/
    ├── images/           # Images statiques
    └── logo.png         # Logo Noorea
```

## 🎯 Fonctionnalités principales

### ✅ Implémentées
- [x] Design responsive premium
- [x] Page d'accueil avec hero section
- [x] Navigation élégante avec animations
- [x] Cartes produits avec effets hover
- [x] Système de routes Laravel
- [x] Architecture MVC complète
- [x] Palette de couleurs et typographie premium

### 🚧 En cours de développement
- [ ] Catalogue produits avec filtres
- [ ] Système d'authentification
- [ ] Panier d'achat
- [ ] Wishlist utilisateur
- [ ] Intégration WhatsApp Business
- [ ] Panel administrateur
- [ ] Blog "Beauté du Monde"

### 📋 À venir
- [ ] Système de paiement mobile money
- [ ] Recommandations personnalisées
- [ ] Programme de fidélité
- [ ] Application mobile (PWA)
- [ ] Analytics avancées

## 🎨 Guide de contribution

### Standards de code
- Suivre les conventions Laravel
- Utiliser PSR-12 pour PHP
- Préfixer les classes CSS avec `noorea-`
- Documenter les fonctions complexes

### Workflow Git
1. Créer une branche feature : `git checkout -b feature/nom-feature`
2. Commiter les changements : `git commit -m "feat: description"`
3. Pousser la branche : `git push origin feature/nom-feature`
4. Créer une Pull Request

## 📊 Objectifs commerciaux (12 mois)

### KPIs ciblés
- **Trafic mensuel** : 50 000 visiteurs
- **Taux de conversion** : >2.5%
- **Panier moyen** : 45 000 FCFA
- **Taux de fidélisation** : 40%
- **Engagement réseaux sociaux** : 5%

## 📱 Contact & Support

- **Email** : dev@noorea.sn
- **WhatsApp Business** : +221 76 123 45 67
- **Adresse** : 123 Avenue de la Beauté, Dakar, Sénégal

## 📄 Licence

Ce projet est sous licence propriétaire. Tous droits réservés © 2025 Noorea.

---

<p align="center">
  <em>Fait avec ❤️ pour célébrer la beauté multiculturelle</em>
</p>

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
