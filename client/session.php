<?php
session_start();
$client_id = $_SESSION['client_id'];
$_SESSION['prenom'] = $prenom;
$_SESSION['nom'] = $nom;
$_SESSION['email'] = $email;
$_SESSION['mot_de_passe'] = $mot_de_passe;// Inclure le fichier db.php pour la connexion à la base de données
?>