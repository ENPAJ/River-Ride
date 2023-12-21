<!-- client_choisir_hebergement.php -->
<?php
  require_once '../db.php';

  ?>  
  <!--  end dashboard_head.php   -->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    $sql = "SELECT * FROM pointarret";
    $stmt = $conn->query($sql);
    $pointarret = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un Hébergement</title>
</head>
<body>
    <h2>Choisir un Hébergement</h2>
    <form action="client_afficher_details_hebergement.php" method="post">
        <label for="point_arret">Point d'Arrêt :</label>
        <select name="point_arret" required>
            <?php
            // Chargez les points d'arrêt depuis la base de données et affichez-les comme options
            $sql = "SELECT * FROM pointarret";
            $stmt = $conn->query($sql);
            $pointarrets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($pointarrets as $pointarret) {
                echo '<option value="' . $pointarret['point_arret_id'] . '">' . htmlspecialchars($pointarret['nom']) . '</option>';
            }
            ?>
        </select><br>

        <label for="date_debut">Date de Début :</label>
        <input type="date" name="date_debut" required><br>
        <label for="date_fin">Date de Fin :</label>
        <input type="date" name="date_fin" required><br>

        <label for="capacite">Nombre de Personnes :</label>
        <input type="number" name="capacite" required><br>

        <input type="submit" value="Afficher Hébergements Disponibles">
    </form>
    <button onclick="history.back()">Retour</button>

</body>
</html>
