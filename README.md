**Projet hotel**

Ce projet est un site web de réservation d’hôtel développé en PHP / MySQL, avec une interface moderne en Bootstrap.
Il permet aux utilisateurs de consulter les chambres, réserver, contacter l’hôtel et gérer leur compte.

**Fonctionnalités principales**

**Utilisateurs**

Inscription et connexion sécurisée

Gestion de session

Profil utilisateur

Choix d’avatar (homme / femme)

Déconnexion avec confirmation

**Chambres**

Affichage des chambres disponibles

Détails des chambres

Réservation de chambre

**Contact**

Formulaire de contact

Enregistrement des messages en base de données

**Administration (si activée)**

Connexion administrateur

Gestion des chambres

Consultation des messages de contact

**Technologies utilisées**

PHP (procédural + PDO)

MySQL

HTML5 / CSS3

Bootstrap 5

Font Awesome

WampServer / XAMPP (en local)

**Installation**

**1️ Installer WampServer / XAMPP**

**2️ Copier le projet dans :**
C:\wamp\www\projet-hotel

**3️ Créer une base de données MySQL**

**4️ Importer les tables**

**5️ Configurer la connexion dans:**

config/db.php

$pdo = new PDO(
    "mysql:host=localhost;dbname=hotel;charset=utf8",
    "root",
    ""
);


**6️ Lancer le site :**

http://127.0.0.1/projet-hotel

**Sécurité**

Mots de passe hashés avec password_hash()

Protection contre les injections SQL (PDO)

Vérification des sessions

Échappement des données (htmlspecialchars)

**Améliorations possibles**

Paiement en ligne

Tableau de bord administrateur avancé

Upload d’avatar personnalisé

Gestion des réservations

Envoi d’email (SMTP)

**Auteur**

Béatrice-crémélia ONDAGUI NGALA
Projet réalisé dans le cadre d’un apprentissage en développement web PHP.
