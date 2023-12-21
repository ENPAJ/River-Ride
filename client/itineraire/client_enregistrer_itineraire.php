<?php
// Inclure le fichier de connexion à la base de données
require_once '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = 1; // Remplacez par l'ID du client actuel

    // Capturer les données du formulaire
    $date_debut = $_POST['date_debut']; // Tableau des dates de début par point d'arrêt
    $date_fin = $_POST['date_fin']; // Tableau des dates de fin par point d'arrêt
    $client_id = ($_POST['client_id'] === null) ? 1 : $_POST['client_id'];

    // Insérer l'itinéraire dans la table Itineraire
    $sql = "INSERT INTO Itineraire (client_id) VALUES (:client_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
    $stmt->execute();

    $itineraire_id = $conn->lastInsertId();

    // Insérer les points d'arrêt sélectionnés dans la table ItinerairePointArret
    foreach ($_POST['points_selectionnes'] as $point_id) {
        $ordre = $_POST['ordre'][$point_id];
        $date_debut_point = $date_debut[$point_id]; // Date de début pour ce point d'arrêt
        $date_fin_point = $date_fin[$point_id]; // Date de fin pour ce point d'arrêt

        $sqlInsertItinerairePointArret = "INSERT INTO itinerairepointarret (itineraire_id, point_arret_id, ordre) VALUES (:itineraire_id, :point_arret_id, :ordre)";
        $stmtInsertItinerairePointArret = $conn->prepare($sqlInsertItinerairePointArret);
        $stmtInsertItinerairePointArret->bindParam(':itineraire_id', $itineraireId);
        $stmtInsertItinerairePointArret->bindParam(':point_arret_id', $pointArretId);
        $stmtInsertItinerairePointArret->bindParam(':ordre', $ordre);
        $stmtInsertItinerairePointArret->execute();

        $sqlInsertItineraire = "INSERT INTO itineraire (client_id, date_debut, date_fin) VALUES (:client_id, :date_debut, :date_fin)";
        $stmtInsertItineraire = $conn->prepare($sqlInsertItineraire);
        $stmtInsertItineraire->bindParam(':client_id', $clientId);
        $stmtInsertItineraire->bindParam(':date_debut', $dateDebut);
        $stmtInsertItineraire->bindParam(':date_fin', $dateFin);
        $stmtInsertItineraire->execute();
    }

    // Rediriger ou afficher un message de succès
    header("location: client_afficher_itineraires.php"); // Rediriger vers une page de confirmation
    exit;
}
?>
