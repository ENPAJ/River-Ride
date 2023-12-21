<!-- client_composer_itineraire.php -->
<?php
$title = "Composer Itinéraire";
require_once '../db.php';
include '../client_head.php';
include '../client_navbar.php';
?>

<h2 style="display: flex; justify-content: center;">Composer Itinéraire</h2>
<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <form action="client_afficher_itineraires.php" method="post">
        <?php
        if (isset($_POST['points_selectionnes']) && is_array($_POST['points_selectionnes'])) {
            // Récupérez les points d'arrêt sélectionnés depuis le formulaire précédent
            $points_selectionnes = $_POST['points_selectionnes'];

            // Affichez les points d'arrêt sélectionnés pour les classer
            foreach ($points_selectionnes as $point_id) {
                // Recherchez le point d'arrêt correspondant dans la base de données
                $sql = "SELECT * FROM pointarret WHERE point_arret_id = :point_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":point_id", $point_id, PDO::PARAM_INT);
                $stmt->execute();
                $pointarretItem = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($pointarretItem) {
                    echo '<input type="hidden" name="points_selectionnes[]" value="' . $point_id . '">';
                    echo htmlspecialchars($pointarretItem['nom']);
                    echo '<input type="hidden" name="client_id" value="1">';
                    echo '<input type="number" name="ordre[' . $point_id . ']" placeholder="Ordre">';
                    echo '<br>';
                    echo 'Date de début : <input type="date" name="date_debut[' . $point_id . ']" required><br>';
                    echo 'Date de fin : <input type="date" name="date_fin[' . $point_id . ']" required><br>';
                }
            }
            
            if (empty($points_selectionnes)) {
                echo '<div class="alert alert-success" role="warning">
                        <h4 class="alert-heading">Composer Itinéraire</h4>
                        <p>Aucun Itinéraire sélectionné.</p>
                    </div>';
            } else {
                echo '<br><br><button type="submit" class="btn btn-primary btn-lg">Composer</button>';
            }
        }
        ?>
    </form>
</div>
<?php
include '../client_footer.php';
?>
