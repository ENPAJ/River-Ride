<?php
  require_once '../db.php';
    $title= "Liste des Services Complémentaires";
  ?>  
  <!--  end dashboard_head.php   -->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    $sql = "SELECT * FROM services";
    $stmt = $conn->query($sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- client_afficher_services.php -->
<?php
include '../client_head.php';
include '../client_navbar.php';
?>
    <h2 style="display: flex; justify-content: center;">Liste des Services Complémentaires</h2>
    <div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <form action="client_acheter_services.php" method="post">
            <?php
                // Chargez les services complémentaires depuis la base de données et affichez-les avec des cases à cocher
                foreach ($services as $serviceItem) {
                    echo '<label class="list-group list-group-flush">';
                    echo '<input class="list-group-item" type="checkbox" name="services_selectionnes[]" value="' . $serviceItem['service_id'] . '">';
                    echo htmlspecialchars($serviceItem['nom']) . ' - Coût : ' . $serviceItem['cout'];
                    echo '</label><br>';
                }
                echo '<br><br><button type="submit" class="btn btn-primary btn-lg">Acheter Services Complémentaires</button>';
            ?>
        </form>
    </div>

<?php
include '../client_footer.php';
?>
