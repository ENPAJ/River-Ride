<?php
// Supposons que vous ayez déjà récupéré les données nécessaires pour la réservation et que vous avez calculé le prix total

// Code pour valider la réservation, insérer les données dans la table Réservations, etc.

// Mettre à jour le statut du logement dans la base de données
$statutIndisponible = 'indisponible';
$logementId = $logement['logement_id']; // supposons que vous ayez récupéré l'ID du logement depuis la base de données

try {
    $sql = "UPDATE Logements SET statut = :statut WHERE logement_id = :logement_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':statut', $statutIndisponible, PDO::PARAM_STR);
    $stmt->bindParam(':logement_id', $logementId, PDO::PARAM_INT);
    $stmt->execute();

    // Autres actions après la mise à jour (par exemple, rediriger l'utilisateur, afficher un message de succès, etc.)
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo "Erreur PDO : " . $e->getMessage();
}
?>
