# Event Management API 🚀

Une API robuste et scalable pour la gestion d'événements, construite avec **Laravel 11**, **Sanctum** pour l'authentification, et une architecture propre.

## ✨ Fonctionnalités

- 🔐 **Authentification Sécurisée** : Gestion des utilisateurs avec Laravel Sanctum (Token-based).
- 📅 **Gestion des Événements** : CRUD complet pour les événements.
- 📝 **Inscriptions** : Système d'inscription avec validation de la capacité et détection des doublons.
- 📊 **Pagination** : Listes optimisées avec pagination personnalisable.
- 🛡️ **Validation Robuste** : Utilisation de Form Requests pour une validation stricte des données.
- 🧩 **Réponses Homogènes** : Structure de réponse API cohérente pour faciliter l'intégration frontend.

## 🛠️ Stack Technique

- **Framework** : Laravel 11
- **Authentification** : Laravel Sanctum
- **Base de données** : SQLite (par défaut) / MySQL
- **Validation** : Form Requests
- **Architecture** : Trait-based API responses, Controller-Model-Request

## 🚀 Installation

1. **Cloner le dépôt** :
   ```bash
   git clone <repository-url>
   cd event-backend
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configuration de l'environnement** :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migration et Seeding** :
   ```bash
   php artisan migrate --seed
   ```

5. **Lancer le serveur** :
   ```bash
   php artisan serve
   ```

## 📖 Documentation de l'API

### Authentification
- `POST /api/register` : Créer un nouveau compte.
- `POST /api/login` : Se connecter et obtenir un token.
- `POST /api/logout` : Se déconnecter (authentifié).
- `GET /api/me` : Obtenir les infos de l'utilisateur actuel (authentifié).

### Événements
- `GET /api/events` : Liste des événements (paginée).
- `GET /api/events/{id}` : Détails d'un événement.
- `POST /api/events` : Créer un événement (authentifié).
- `PUT /api/events/{id}` : Modifier un événement (authentifié).
- `DELETE /api/events/{id}` : Supprimer un événement (authentifié).

### Inscriptions
- `POST /api/events/{id}/register` : S'inscrire à un événement.
- `GET /api/events/{id}/registrations` : Liste des inscrits (authentifié).
- `DELETE /api/registrations/{id}` : Annuler une inscription (authentifié).

## 🧪 Tests

```bash
php artisan test
```

---
Développé avec ❤️ par Antigravity.
