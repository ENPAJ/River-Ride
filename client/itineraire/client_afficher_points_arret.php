  <!--  start dashboard_head.php   -->
  <?php
  require_once '../db.php';
$title = "Liste des Points d'Arrêt";
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

<!-- client_afficher_points_arret.php -->
<?php
include '../client_head.php';
include '../client_navbar.php';
?>
    <h2 style="display: flex; justify-content: center;">Liste des Points d'Arrêt</h2>
<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <form action="client_composer_itineraire.php" method="post">
        <?php
            // Chargez les points d'arrêt depuis la base de données et affichez-les avec des cases à cocher
            foreach ($pointarret as $pointarretItem) {
                echo '<label>';
                echo '<input type="checkbox" name="points_selectionnes[]" value="' . $pointarretItem['point_arret_id'] . '">';
                echo htmlspecialchars($pointarretItem['nom']);
                echo '</label><br>';
            }
            echo '<br><br><button type="submit" class="btn btn-primary btn-lg">Composer Itinéraire</button>';

        ?>
    </form>
    </div>

<?php
include '../client_footer.php';
?>
