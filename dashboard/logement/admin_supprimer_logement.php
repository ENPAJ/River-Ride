<!-- admin_supprimer_logement.php -->
<?php
// Code pour vérifier l'authentification de l'admin ici...
// ...

include '../dashboard_head.php';
require_once '../db.php';

// Code pour récupérer l'ID du logement à supprimer depuis l'URL
if (isset($_GET['logement_id']) && is_numeric($_GET['logement_id'])) {
    $logement_id = intval($_GET['logement_id']);

    try {
        // Supprimer le logement de la table Logement
        $sql_delete_logement = "DELETE FROM Logement WHERE logement_id = :logement_id";
        $stmt_delete_logement = $conn->prepare($sql_delete_logement);
        $stmt_delete_logement->bindParam(':logement_id', $logement_id, PDO::PARAM_INT);
        $stmt_delete_logement->execute();

        // Supprimer les photos du logement de la table PhotosLogement
        $sql_delete_photos = "DELETE FROM PhotosLogement WHERE logement_id = :logement_id";
        $stmt_delete_photos = $conn->prepare($sql_delete_photos);
        $stmt_delete_photos->bindParam(':logement_id', $logement_id, PDO::PARAM_INT);
        $stmt_delete_photos->execute();

        // Fermer la connexion à la base de données
        $conn = null;

        // Après la suppression du logement, redirigez vers une page de confirmation ou une autre page appropriée.
        // Par exemple :
        header("Location: admin_afficher_logement.php?suppression_reussie=true");
        exit();

    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // Vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur personnalisée
        echo "Erreur PDO : " . $e->getMessage();
        // Rediriger en cas d'erreur
        header("Location: admin_afficher_logement.php");
        exit();
    }
}
?>
