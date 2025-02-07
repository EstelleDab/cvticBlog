# L316 - Groupe A

---

**Pré-requis**

- Une base de données MySQL
- Composer

**Installer le projet**

- Paramétrer la variable "DATABASE_URL" dans le .env

````
Valeur par défaut :

DATABASE_URL="mysql://root:@127.0.0.1:3306/cvticBlog?serverVersion=8.0.32&charset=utf8mb4"
````

- Installer les dépendances

```` shell
composer install
````

- Construire la base de données / faire les migrations

```` shell
php bin/console doctrine:database:create
php bin/console d:m:diff
php bin/console d:m:m
````

- Écrire les fixtures :

```` shell
php bin/console doctrine:fixtures:load
````

**Informations de connexion**

| Type utilisateur      | Identifiant connexion | Mot de passe |
|-----------------------|-----------------------|--------------|
| Utilisateur classique | user@example.com      | 123          |
| Administrateur        | admin@example.com     | 123          |

URL administration (CRUD) : **/admin**