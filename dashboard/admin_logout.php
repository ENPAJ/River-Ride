<!-- admin_logout.php -->
<?php
// Page de déconnexion pour l'administrateur
session_start();
// Supprimez toutes les variables de session
session_unset();
// Détruisez la session
session_destroy();
// Redirigez vers la page de connexion de l'administrateur
header("location: admin_login.php");
exit;
?>
