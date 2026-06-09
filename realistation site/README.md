# SlahPC - PHP MySQL Project

Projet prêt à ouvrir avec VS Code et XAMPP.

## 1. Installation

1. Copie le dossier `slahpc-code` dans :
   `C:\xampp\htdocs\`
2. Lance XAMPP.
3. Start `Apache` et `MySQL`.
4. Ouvre phpMyAdmin :
   `http://localhost/phpmyadmin`
5. Va dans l'onglet SQL.
6. Exécute le contenu de :
   `scripts/database.sql`
7. Puis exécute :
   `scripts/seed.sql`

## 2. Lancer le site

Ouvre :

`http://localhost/slahpc-code/public/index.php`

## 3. Compte admin de test

Email : `admin@slahpc.ma`

Password : `admin123`

## 4. Structure

```text
slahpc-code/
├── public/          Pages client et visiteur
├── admin/           Dashboard admin
├── includes/        Connexion DB, auth, header, footer
├── assets/css/      Style CSS
├── assets/js/       JavaScript
└── scripts/         SQL database + seed
```

## 5. Modifier la connexion DB

Si ton MySQL a un mot de passe, modifie :

`includes/db.php`

```php
$username = 'root';
$password = '';
```

## 6. Fonctionnalités incluses

- Accueil moderne.
- Services depuis MySQL.
- Contact avec insertion DB.
- Inscription avec `password_hash()`.
- Connexion avec `password_verify()`.
- Création demande de réparation.
- Liste demandes client.
- Détails demande.
- Dashboard admin.
- Gestion statuts/prix/note admin.
- Gestion services.
- Liste utilisateurs.
- Messages contact.
- CSS responsive.
- JS validation simple.
