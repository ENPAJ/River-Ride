<?php
include '../dashboard_head.php';
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $admin_id = intval($_GET['id']);

    try {
        // Code pour supprimer le admin de la base de données
        $sql = "DELETE FROM admin WHERE admin_id = :admin_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();

        // Rediriger après la suppression avec le paramètre de succès
        header("Location: admin_afficher_admin.php?suppression_reussie=true");
        exit();

    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // Vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur personnalisée
        echo "Erreur PDO : " . $e->getMessage();
        // Rediriger en cas d'erreur
        header("Location: admin_afficher_admin.php");
        exit();
    }
}
?>
