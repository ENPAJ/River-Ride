<!-- client_afficher_details_hebergement.php -->
<?php
require_once '../db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupérez les données du formulaire précédent
$point_arret_id = $_POST['point_arret'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$capacite = $_POST['capacite'];

// Chargez les logements disponibles à partir de la base de données en utilisant les critères fournis
$sql = "SELECT logement.*, hebergement.nom AS nom_hebergement, hebergement.statut AS statut_hebergement
        FROM logement
        INNER JOIN hebergement ON logement.hebergement_id = hebergement.hebergement_id
        WHERE hebergement.point_arret_id = :point_arret_id
        AND hebergement.statut = 'ouvert'
        AND logement.capacite >= :capacite
        AND logement.statut = 'disponible'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":point_arret_id", $point_arret_id, PDO::PARAM_INT);
$stmt->bindParam(":capacite", $capacite, PDO::PARAM_INT);
$stmt->execute();
$logements_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérez le nom du point d'arrêt
$sql_point_arret = "SELECT nom FROM pointarret WHERE point_arret_id = :point_arret_id";
$stmt_point_arret = $conn->prepare($sql_point_arret);
$stmt_point_arret->bindParam(":point_arret_id", $point_arret_id, PDO::PARAM_INT);
$stmt_point_arret->execute();
$point_arret_nom = $stmt_point_arret->fetchColumn();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logements Disponibles</title>
</head>
<body>
    <h2>Logements Disponibles</h2>
    <p>Point d'Arrêt : <?php echo $point_arret_nom; ?></p>
    <p>Date de Début : <?php echo $date_debut; ?></p>
    <p>Date de Fin : <?php echo $date_fin; ?></p>
    <p>Nombre de Personnes : <?php echo $capacite; ?></p>

    <?php if (empty($logements_disponibles)) : ?>
        <p>Aucun logement correspondant aux critères n'a été trouvé.</p>
    <?php else : ?>
        <h3>Liste des Logements Disponibles :</h3>
        <ul>
            <?php foreach ($logements_disponibles as $logement) : ?>
                <li>
                <a href="details_logement.php?chambre=<?php echo $logement['chambre']; ?>&douche=<?php echo $logement['douche']; ?>&prix=<?php echo $logement['prix']; ?>&photo=<?php echo $logement['photo']; ?>&description=<?php echo urlencode($logement['description']); ?>&point_arret_id=<?php echo $point_arret_id; ?>&date_debut=<?php echo $date_debut; ?>&date_fin=<?php echo $date_fin; ?>&capacite=<?php echo $capacite; ?>">
                    <?php echo $logement['nom_hebergement']; ?>
                </a>
                    - Prix : <?php echo $logement['prix'].'€ par nuit'; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button onclick="history.back()">Retour</button>

</body>
</html>
