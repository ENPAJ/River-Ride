<!-- client_consulter_reservations.php -->
<?php
include 'dashboard_head.php';
require_once 'db.php';

// Assurez-vous que le client est connecté et récupérez son ID
// ...

// Récupérez les réservations du client depuis la base de données
$client_id = 123; // Remplacez par l'ID du client connecté
$sql = "SELECT R.reservation_id, R.date_reservation, H.nom AS nom_hebergement, I.nom AS nom_itineraire, S.nom AS nom_service, P.nom AS nom_pack
        FROM Reservations R
        LEFT JOIN Hebergements H ON R.hebergement_id = H.hebergement_id
        LEFT JOIN Itineraires I ON R.itineraire_id = I.itineraire_id
        LEFT JOIN Services S ON R.service_id = S.service_id
        LEFT JOIN Packs P ON R.pack_id = P.pack_id
        WHERE R.client_id = :client_id
        ORDER BY R.date_reservation DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Réservations</title>
</head>
<body>
    <h2>Mes Réservations</h2>

    <?php if (count($reservations) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID Réservation</th>
                    <th>Date Réservation</th>
                    <th>Hébergement</th>
                    <th>Itinéraire</th>
                    <th>Service</th>
                    <th>Pack</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <td><?php echo $reservation['reservation_id']; ?></td>
                        <td><?php echo $reservation['date_reservation']; ?></td>
                        <td><?php echo $reservation['nom_hebergement']; ?></td>
                        <td><?php echo $reservation['nom_itineraire']; ?></td>
                        <td><?php echo $reservation['nom_service']; ?></td>
                        <td><?php echo $reservation['nom_pack']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
</body>
</html>
