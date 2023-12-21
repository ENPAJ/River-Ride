<?php
require_once '../db.php';

// Récupérer l'ID du logement depuis l'URL
if (isset($_GET['id'])) {
    $logementId = $_GET['id'];

    // Interroger la base de données pour obtenir les détails du logement
    $sql = "SELECT * FROM logement WHERE logement_id = :logement_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':logement_id', $logementId, PDO::PARAM_INT);
    $stmt->execute();
    $logement = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Logement</title>
</head>
<body>
    <?php if ($logement) : ?>
        <h2>Réservation de Logement</h2>
        <img src="<?php echo $logement['photo']; ?>" alt="Photo du Logement">

        <h3>Informations sur le Logement :</h3>
        <p>Chambre(s) : <?php echo $logement['chambre']; ?></p>
        <p>Douche(s) : <?php echo $logement['douche']; ?></p>
        <p>Capacité : <?php echo $logement['capacite']; ?></p>
        <p>Prix : <?php echo $logement['prix']; ?> €</p>
        <p>Statut : <?php echo $logement['statut']; ?></p>

        <h3>Description du Logement :</h3>
        <p><?php echo htmlspecialchars($logement['description']); ?></p>

        <!-- Formulaire pour effectuer la réservation -->
        <form action="confirmation_reservation.php" method="post">
            <input type="hidden" name="logement_id" value="<?php echo $logement['logement_id']; ?>">
            <label for="date_debut">Date d'Arrivée :</label>
            <input type="date" id="date_debut" name="date_debut" required>
            <label for="date_fin">Date de Départ :</label>
            <input type="date" id="date_fin" name="date_fin" required>
            <button type="submit">Confirmer la Réservation</button>
        </form>

        <!-- Bouton pour revenir à la page précédente -->
        <button onclick="history.back()">Retour</button>
    <?php else : ?>
        <p>Logement non trouvé.</p>
    <?php endif; ?>
</body>
</html>
