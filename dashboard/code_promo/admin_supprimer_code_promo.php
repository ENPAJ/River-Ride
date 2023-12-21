<?php
include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $codepromo_id = intval($_GET['id']);

    try {
        // Vérifier si le code promo existe dans la base de données
        $sql_delete = "DELETE FROM CodePromo WHERE codepromo_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->execute([$codepromo_id]);

        // Rediriger vers une page de confirmation
        header("Location: admin_supprimer_code_promo_confirm.php");
        exit();
    
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // Vous pouvez afficher un message d'erreur ou rediriger vers une page d'erreur personnalisée
        echo "Erreur PDO : " . $e->getMessage();
        // Rediriger en cas d'erreur
        header("Location: admin_afficher_codes_promo.php");
        exit();
    }
}
?>

