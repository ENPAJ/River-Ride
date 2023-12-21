<!--client_traiter_reservation.php-->

<!-- Cette page reçoit les informations du formulaire de sélection d'hébergement et 
effectue la réservation en mettant à jour la disponibilité des hébergements. -->
<?php
  require_once '../db.php';

  ?>  

<?php
// Récupérez les données du formulaire de sélection d'hébergement
$point_arret_id = $_POST['point_arret_id'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$capacite = $_POST['capacite'];
$hebergement_id = $_POST['hebergement_id']; // ID de l'hébergement sélectionné

// Chargez l'hébergement sélectionné depuis la base de données
// ...

// Vérifiez la disponibilité de l'hébergement pour les dates et le nombre de personnes
// ...

// Enregistrez la réservation dans la base de données et mettez à jour la disponibilité de l'hébergement
try {
    $conn->beginTransaction();

    // Insérez la réservation dans la table Réservations
    $sql_reservation = "INSERT INTO Reservations (hebergement_id, date_debut, date_fin, capacite) VALUES (?, ?, ?, ?)";
    $stmt_reservation = $conn->prepare($sql_reservation);
    $stmt_reservation->execute([$hebergement_id, $date_debut, $date_fin, $capacite]);
    
    // Mettez à jour la disponibilité de l'hébergement dans la table Hébergements
    $sql_maj_disponibilite = "UPDATE Hebergement SET statut = statut - ? WHERE hebergement_id = ?";
    $stmt_maj_disponibilite = $conn->prepare($sql_maj_disponibilite);
    $stmt_maj_disponibilite->execute([$capacite, $hebergement_id]);

    $conn->commit();

    // Redirigez vers une page de confirmation de réservation
    header("Location: confirmation_reservation.php");
    exit();

} catch (PDOException $e) {
    $conn->rollBack();
    // Gérez l'erreur (affichage, journalisation, etc.)
    echo "Une erreur est survenue : " . $e->getMessage();
}
?>
