<!-- db.php -->
<?php

// Remplacez les valeurs suivantes par les informations de votre base de données
$servername = "riverru855.mysql.db";
$username = "riverru855";
$password = "8JEu5NxUGZuS";
$dbname = "riverru855";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs en mode développement
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configuration du jeu de caractères UTF-8
    $conn->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("La connexion a échoué : " . $e->getMessage());
}

?>
