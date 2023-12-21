<!-- logout.php -->
<?php
// Page de déconnexion pour les clients
session_start();
// Supprimez toutes les variables de session liées au client
session_unset();
// Détruisez la session
session_destroy();
// Redirigez vers la page de connexion des clients (par exemple, login.php)
header("location: login.php");
exit;
?>
