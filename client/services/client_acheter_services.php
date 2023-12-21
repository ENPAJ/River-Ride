<!-- client_acheter_services.php -->
<?php
require_once '../db.php';
$title = "Acheter Services Complémentaires";

// Vérifiez si des services ont été sélectionnés dans le formulaire précédent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['services_selectionnes'])) {
    $services_selectionnes = $_POST['services_selectionnes'];

    // Obtenez les informations sur les services sélectionnés depuis la base de données
    $services_info = array();
    foreach ($services_selectionnes as $service_id) {
        $sql = "SELECT * FROM services WHERE service_id = :service_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
        $stmt->execute();
        $service_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($service_info) {
            $services_info[] = $service_info;
        }
    }
}
?>

<?php
include '../client_head.php';
include '../client_navbar.php';
?>
    <h2 style="display: flex; justify-content: center;">Acheter Services Complémentaires</h2>
    <div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <?php
            if (isset($services_info) && is_array($services_info) && count($services_info) > 0) {
                echo '<form action="client_paiement_services.php" method="post">';
                echo '<div class="container">';
                
                foreach ($services_info as $serviceInfo) {
                    echo '<div class="row">';
                    echo '<div class="col">' . htmlspecialchars($serviceInfo['nom']) . '</div>';
                    echo '<div class="col">' . $serviceInfo['cout'] . '€'.'</div>';
                    echo '</div>';
                    echo '<input type="hidden" name="services_selectionnes[]" value="' . $serviceInfo['service_id'] . '">';
                }
                
                echo '<br><br><button type="submit" class="btn btn-primary btn-lg">Procéder au Paiement</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                        <div class="alert alert-success" role="warning">
                            <h4 class="alert-heading">Paiement des Services</h4>
                            <p>Aucun service sélectionné.</p>
                        </div>
                    </div>';
            }
        ?>
    </div>

<?php
include '../client_footer.php';
?>
