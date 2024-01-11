# 🚤 River Ride

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/votreutilisateur/river-ride.svg?branch=main)](https://travis-ci.org/votreutilisateur/river-ride)
[![GitHub Issues](https://img.shields.io/github/issues/votreutilisateur/river-ride.svg)](https://github.com/votreutilisateur/river-ride/issues)
[![GitHub Forks](https://img.shields.io/github/forks/votreutilisateur/river-ride.svg)](https://github.com/votreutilisateur/river-ride/network)
[![GitHub Stars](https://img.shields.io/github/stars/votreutilisateur/river-ride.svg)](https://github.com/votreutilisateur/river-ride/stargazers)
[![PHP](https://img.shields.io/badge/PHP-7.4-blue)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)](https://www.mysql.com/)
[![CSS](https://img.shields.io/badge/CSS-3-green)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![HTML](https://img.shields.io/badge/HTML-5-orange)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![VS Code](https://img.shields.io/badge/VS_Code-1.60-blue)](https://code.visualstudio.com/)
[![Wamp](https://img.shields.io/badge/Wamp-3.2.5-red)](https://www.wampserver.com/en/)
<!-- Ajoutez d'autres badges au besoin -->

## 🌄 Aperçu

River Ride permet aux voyageurs de découvrir la Loire, de gérer leur itinéraire, de louer des équipements et des chambres d'hôtel.

## 🚀 Fonctionnalités

- Fonctionnalité 1 : Créer un compte sur le site web
- Fonctionnalité 2 : Construire un itinéraire de voyage
- Fonctionnalité 3 : Effectuer des réservations dans des hôtels
- Fonctionnalité 4 : Acheter des services complémentaires

## ⚙️ Installation

Pour utiliser ce projet, suivez ces étapes si vous souhaitez mettre en place un serveur MAMP sur Windows :

1. **Téléchargement de MAMP :**
   - Téléchargez la version Windows de MAMP depuis le site officiel (https://www.mamp.info/).

2. **Lancement de MAMP :**
   - Recherchez et lancez l'application MAMP.

3. **Démarrage des serveurs :**
   - Dans l'onglet "Start/Stop" de MAMP, cliquez sur "Start Servers" pour activer Apache et MySQL.

4. **Vérification du serveur :**
   - Ouvrez votre navigateur à l'adresse `http://localhost:8888/` (ou `http://localhost/` pour le port 80 par défaut) pour confirmer que le serveur fonctionne.

5. **Configuration du dossier racine :**
   - Dans l'onglet "Preferences" de MAMP, définissez le dossier racine (Document Root) pour vos projets. Par défaut, il est dans le dossier "htdocs" de l'installation.

6. **Configuration de la base de données MySQL :**
   - Accédez à l'onglet "phpMyAdmin" pour gérer vos bases de données MySQL.
   - Cliquez sur *New* pour créer une nouvelle base de données.
   - Puis sur *Import* pour importer une base de données.
   - Sélectionez le fichier nommé *riverride.sql*. 

Félicitations ! Vous avez maintenant un serveur MAMP opérationnel sur votre machine Windows, ainsi qu'une base de données fonctionnelle. Il est temps de donner vie à votre application ! N'hésitez pas à tester et explorer toutes les fonctionnalités. Bon codage ! 🚀

Voici les étapes à suivre pour un serveur Apache sur une machine Linux: 

Pour cloner un projet Git dans le répertoire `/var/www/html/` sur un serveur Apache et importer une base de données, suivez ces étapes :

1. **Accès au répertoire de publication :**
   - Ouvrez un terminal sur votre serveur.

2. **Navigation vers le répertoire racine :**
   - Utilisez la commande `cd /var/www/html/` pour accéder au répertoire HTML.

3. **Clonage du projet :**
   - Utilisez la commande `git clone ` pour cloner le projet Git dans le répertoire actuel.
     ```
     git clone https://github.com/ENPAJ/River-Ride.git
     ```

4. **Configuration du serveur Apache :**
   - Assurez-vous que le fichier de configuration Apache pointe vers le bon répertoire. Vous pouvez le vérifier dans le fichier de configuration d'Apache, souvent situé dans `/etc/apache2/sites-available/`.

5. **Redémarrage du serveur Apache :**
   - Si vous avez eu besoin de modifier la configuration, redémarrez Apache pour appliquer les changements.
     ```
     sudo service apache2 restart
     ```

**Importation de la base de données :**

1. **Accès à MySQL :**
   - Ouvrez un terminal et connectez-vous à MySQL en utilisant la commande :
     ```
     mysql -u [votre_nom_utilisateur] -p
     ```

2. **Création de la base de données :**
   - Créez une nouvelle base de données (si elle n'existe pas déjà) :
     ```
     CREATE DATABASE riverride;
     ```

3. **Sélection de la base de données :**
   - Sélectionnez la base de données nouvellement créée :
     ```
     USE riverride;
     ```

4. **Importation de la base de données :**
   - Utilisez la commande `mysql` pour importer le fichier SQL dans la base de données :
     ```
     mysql -u [votre_nom_utilisateur] -p riverride < /var/www/html/River-Ride/riverride.sql
     ```


Assurez-vous d'adapter les commandes avec les informations spécifiques à votre projet, comme l'URL du projet Git, le nom de la base de données, le nom d'utilisateur MySQL, et le chemin vers le fichier SQL. Après avoir suivi ces étapes, votre projet Git devrait être cloné dans `/var/www/html/` et la base de données associée devrait être importée.

Félicitations ! Vous avez désormais un serveur Apache pleinement fonctionnel sur votre machine Linux, accompagné d'une base de données opérationnelle. Il est maintenant temps de donner vie à votre application ! N'hésitez pas à explorer toutes les fonctionnalités et à tester votre projet. Bon codage ! 🚀

<!-- Ajoutez d'autres étapes d'installation si nécessaire -->

## 🤝 Contribuer

Nous sommes ouverts aux contributions ! Si vous souhaitez contribuer à ce projet, veuillez suivre ces étapes :

1. Forkez le projet sur GitHub.
2. Créez une nouvelle branche pour votre fonctionnalité :
    ```bash
    git checkout -b nouvelle-fonctionnalite
    ```

3. Effectuez vos modifications et committez-les :
    ```bash
    git commit -m "ajouter ma nouvelle fonctionnalité"
    ```

4. Poussez votre branche vers votre fork :
    ```bash
    git push origin ma-nouvelle-fonctionnalite
    ```

5. Créez une Pull Request sur GitHub.

Nous apprécions toutes les contributions !

---

N'hésitez pas à personnaliser ce fichier README en fonction des besoins spécifiques de votre projet.
 

## :dividers  Connection à la base de données 
   C'est le fichier ```bd.php``` à la racine de River-Ride qui gère la connection à la base de données. 
   N'oubliez pas de modifier les identifiants pour pouvoir vous connecter à votre base de données pour pouvoir effectuer vos tests et de les remettre à leurs valeurs initiales avant toute pull request.

    

## 📄 Licence

Ce projet est sous licence MIT - consultez le fichier LICENSE pour plus de détails.

## 📞 Contact

Fournissez vos informations de contact au cas où les utilisateurs auraient des questions ou voudraient vous joindre.

[https://github.com/ENPAJ/](https://github.com//ENPAJ/))

## 🏷️ Tags

Tags pertinents :

- River Ride
- PHP
- MySQL
- Développement Web
- Voyage
