<?php
// admin_auth.php

// Démarrez la session
session_start();

// Vérifiez si l'administrateur est connecté
function isAdminLoggedIn() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

?>

