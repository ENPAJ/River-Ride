<?php
include '../dashboard_head.php';
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $point_arret_id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nom'], $_POST['description'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $description = htmlspecialchars($_POST['description']);

            try {
                // Code pour mettre à jour le point d'arrêt dans la base de données
                $sql = "UPDATE PointArret SET nom = :nom, description = :description WHERE id = :point_arret_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_INT);
                $stmt->execute();

                header("Location: admin_afficher_point_arrets.php");
                exit();

            } catch (PDOException $e) {
                // Gérer les erreurs PDO
                // ...
            }
        }
    }

    // Récupérer les informations du point d'arrêt pour affichage dans le formulaire
    try {
        $sql = "SELECT * FROM PointArret WHERE id = :point_arret_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_INT);
        $stmt->execute();
        $point_arret = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$point_arret) {
            // Point d'arrêt non trouvé, rediriger ou afficher un message d'erreur
            // ...
        }

    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        // ...
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un Point d'Arrêt</title>
</head>
<body>
    <h1>Modifier un Point d'Arrêt</h1>
    <form method="post">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($point_arret['nom']); ?>" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea name="description" required><?php echo htmlspecialchars($point_arret['description']); ?></textarea>
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
