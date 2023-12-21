<!-- admin_supprimer_hebergement.php -->
<?php
// Code pour vérifier l'authentification de l'admin ici...
// ...
include '../dashboard_head.php';
require_once '../db.php';

// Code pour récupérer l'ID de l'hébergement à supprimer depuis l'URL
if (isset($_GET['hebergement_id']) && is_numeric($_GET['hebergement_id'])) {
    $hebergement_id = intval($_GET['hebergement_id']);

    try {
        // Supprimer l'hébergement de la table Hebergement
        $sql_delete_hebergement = "DELETE FROM Hebergement WHERE hebergement_id = :hebergement_id";
        $stmt_delete_hebergement = $conn->prepare($sql_delete_hebergement);
        $stmt_delete_hebergement->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_INT);
        $stmt_delete_hebergement->execute();

        // Supprimer les photos de l'hébergement de la table PhotosHebergement
        $sql_delete_photos = "DELETE FROM PhotosHebergement WHERE hebergement_id = :hebergement_id";
        $stmt_delete_photos = $conn->prepare($sql_delete_photos);
        $stmt_delete_photos->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_INT);
        $stmt_delete_photos->execute();

        // Fermer la connexion à la base de données
        $conn = null;

        // Après la suppression de l'hébergement, redirigez vers une page de confirmation ou une autre page appropriée.
        // Par exemple :
        header("Location: admin_afficher_hebergement.php");
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // Vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur personnalisée
        echo "Erreur PDO : " . $e->getMessage();
        // Rediriger en cas d'erreur
        header("Location: admin_afficher_hebergement.php");
        exit();
    }
}
?>
