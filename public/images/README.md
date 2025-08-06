# Structure des images pour Noorea

## 📁 Organisation des dossiers images

### 🎨 `/public/images/hero/`
Images de fond pour les sections hero :
- `about-bg-1.jpg` - Image principale page À propos
- `about-bg-2.jpg` - Image secondaire page À propos
- `categories-bg-1.jpg` - Image principale page Catégories
- `categories-bg-2.jpg` - Image secondaire page Catégories
- `home-bg-1.jpg` - Image principale page d'accueil
- `home-bg-2.jpg` - Image secondaire page d'accueil
- `home-bg-3.jpg` - Image tertiaire page d'accueil

### 🛍️ `/public/images/products/`
Images des produits :
- `cream-1.jpg` - Crème hydratante
- `serum-1.jpg` - Sérum visage
- `oil-1.jpg` - Huile capillaire
- `perfume-1.jpg` - Parfum floral
- `product-[1-7].jpg` - Images produits variés

### 📂 `/public/images/categories/`
Images des catégories :
- `skincare.jpg` - Soins du visage
- `makeup.jpg` - Maquillage
- `perfumes.jpg` - Parfums
- `haircare.jpg` - Soins des cheveux

### 🌄 `/public/images/backgrounds/`
Images de fond diverses :
- `section-bg-1.jpg` - Fond section témoignages
- `section-bg-2.jpg` - Fond section produits vedette
- `pattern-bg.jpg` - Motif de fond

## 🔄 Remplacement des URLs externes

Remplacez progressivement toutes les URLs `https://images.pexels.com/...` et `https://images.unsplash.com/...` par `{{ asset('images/[dossier]/[nom-fichier].jpg') }}`

## ⚡ Avantages des images locales

✅ **Performance** : Chargement plus rapide
✅ **Fiabilité** : Pas de dépendance externe
✅ **Cache** : Contrôle total sur la mise en cache
✅ **SEO** : Optimisation pour les moteurs de recherche
✅ **Offline** : Fonctionne sans connexion internet
