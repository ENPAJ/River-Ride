<?php
include '../dashboard_head.php';
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['point_arret_id']) && is_numeric($_GET['point_arret_id'])) {
    $point_arret_id = intval($_GET['point_arret_id']);

    try {
        // Code pour supprimer le point d'arrêt de la base de données
        $sql = "DELETE FROM pointarret WHERE point_arret_id = :point_arret_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: admin_afficher_point_arret.php?suppression_reussie=true");
        exit();

    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // Vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur personnalisée
        echo "Erreur PDO : " . $e->getMessage();
        // Rediriger en cas d'erreur
        header("Location: admin_afficher_point_arret.php");
        exit();
    }
}
?>
