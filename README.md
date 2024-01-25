# Culinaria

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=symfony&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Bienvenue sur le dépôt de Culinaria, votre solution e-commerce pour une épicerie en ligne. Culinaria est construit avec PHP, utilisant le framework Symfony 6 et stylisé avec Bootstrap 5.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP 8.x
- Composer
- Node.js et npm
- Symfony CLI

## Installation

Pour installer et exécuter Culinaria, suivez les étapes ci-dessous :

1. **Clonez le dépôt :**
   ```bash
   git clone https://github.com/monkeycs60/grocery-symfony.git
   cd Culinaria
    ```

2. **Installez les dépendances :**
    ```bash
    composer install
    npm install
    ```

3. **Configurez votre base de données :**
    ```bash
    symfony console doctrine:database:create
    symfony console doctrine:migrations:migrate
    symfony console doctrine:fixtures:load
    ```

4. **Lancez le serveur :**
    ```bash
    symfony serve
    ```

5. **Rendez-vous sur [localhost:8000](http://localhost:8000) pour voir le site en action !**

## Fonctionnalités

- [x] Authentification
- [x] Gestion des rôles et autorisations
- [x] Gestion du profil utilisateur
- [x] Ajout de produits au panier
- [x] Gestion du panier
- [x] Commande
- [x] Mail de confirmation
- [x] Dashboard administrateur
- [x] Gestion des stocks, des produits et des catégories
- [x] Gestion des commandes

## Auteurs

- [**Clément Serizay**]   