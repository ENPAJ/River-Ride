<!-- client_paiement_services.php -->
<?php
require_once '../db.php';

// Récupérez les services sélectionnés depuis le formulaire précédent
$services_selectionnes = $_POST['services_selectionnes'];
$title = "Paiement des Services";

// Calculez le montant total à payer en additionnant les coûts des services sélectionnés
$total_paiement = 0;
foreach ($services_selectionnes as $service_id) {
    // Chargez le service complémentaire à partir de la base de données
    $sql = "SELECT * FROM services WHERE service_id = :service_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
    $stmt->execute();
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le service a été trouvé, ajoutez son coût au total
    if ($service) {
        $total_paiement += $service['cout'];
    }
}
?>

<?php
include '../client_head.php';
include '../client_navbar.php';
?>

<!-- Contact Start -->
        <div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Paiement des Services</h4>
                <p>Félicitations ! <br>Votre paiement a été correctement effectué.<br>Merci et à très bientôt pour l'achat d'autres services.</p>
                <hr>
                <p class="mb-0">
                    <strong>Montant Total : <?php echo $total_paiement.'€'; ?></strong>
                </p>
            </div>
        </div>

<?php
include '../client_footer.php';
?>
