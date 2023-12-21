<?php
  include '../dashboard_head.php';
  require_once '../db.php';

  ?>  
<!-- admin_supprimer_pack.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Pack</title>
</head>

<body>
    <h1>Supprimer un Pack</h1>
    <?php
    // Code pour vérifier l'authentification de l'admin ici...
    // ...

    // Code pour récupérer l'ID du pack à supprimer depuis l'URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $pack_id = intval($_GET['id']);

        // Code pour supprimer le pack de la base de données
        // Utilisez une requête SQL pour supprimer les données du pack dans la table Pack.
        // ...

        // Après la suppression du pack, redirigez vers une page de confirmation ou une autre page appropriée.
        // Par exemple :
        header("Location: admin_afficher_packs.php");
        exit();
    } else {
        // Rediriger vers une page d'erreur si l'ID du pack n'a pas été fourni correctement dans l'URL
        // Par exemple :
        header("Location: erreur.php");
        exit();
    }
    ?>
</body>

</html>
