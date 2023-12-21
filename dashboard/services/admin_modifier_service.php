<!-- admin_modifier_service.php -->
<?php
include '../dashboard_head.php';
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = intval($_GET['id']);

    // Récupérer les informations du service à modifier
    $sql = "SELECT * FROM Services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $service_id, PDO::PARAM_INT);
    $stmt->execute();
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        header("Location: admin_afficher_services.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = intval($_POST['service_id']);
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $cout = floatval($_POST['cout']);

    // Mettre à jour les informations du service dans la base de données
    $sql = "UPDATE Services SET nom = ?, description = ?, cout = ? WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nom, PDO::PARAM_STR);
    $stmt->bindParam(2, $description, PDO::PARAM_STR);
    $stmt->bindParam(3, $cout, PDO::PARAM_STR);
    $stmt->bindParam(4, $service_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: admin_afficher_services.php");
        exit();
    } else {
        $error_message = "Erreur lors de la mise à jour du service. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Service</title>
</head>
<body>
    <h2>Modifier un Service</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" required><br>
        <label for="description">Description :</label>
        <textarea name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea><br>
        <label for="cout">Coût :</label>
        <input type="number" step="0.01" name="cout" value="<?php echo $service['cout']; ?>" required><br>
        <input type="submit" value="Enregistrer">
    </form>
    <a href="admin_afficher_services.php">Retour à la liste des services</a>
</body>
</html>
