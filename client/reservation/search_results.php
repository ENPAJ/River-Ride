<?php
require_once '../db.php';
$title = "logements associés";
include '../client_head.php';
include '../client_navbar.php';


if (isset($_GET['search'])) {
    $selectedPointArretId = $_GET['selected_point_arret']; // Make sure to sanitize this input

    // Fetch the associated hebergement_id from the pointarret table
    $sqlPointArret = "SELECT hebergement_id FROM hebergement WHERE point_arret_id = :point_arret_id";
    $stmtPointArret = $conn->prepare($sqlPointArret);
    $stmtPointArret->bindParam(':point_arret_id', $selectedPointArretId);
    $stmtPointArret->execute();
    $hebergementIdResult = $stmtPointArret->fetch(PDO::FETCH_ASSOC);

    if ($hebergementIdResult) {
        $hebergementId = $hebergementIdResult['hebergement_id'];

        // Fetch the logements associated with the selected hebergement
        $sqlLogements = "SELECT * FROM logement WHERE hebergement_id = :hebergement_id";
        $stmtLogements = $conn->prepare($sqlLogements);
        $stmtLogements->bindParam(':hebergement_id', $hebergementId);
        $stmtLogements->execute();
        $logements = $stmtLogements->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Handle error if point d'arret doesn't have an associated hebergement
    }
}
?>

<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="alert alert-success" role="alert">
    <?php if (isset($logements)) : ?>
        <h4 class="alert-heading">Liste des logements associés</h4>
        <ul>
            <?php foreach ($logements as $logement) : ?>
                <button type="button" class="btn btn-primary btn-lg btn-block">
                    <a href="details_logement.php?id=<?php echo $logement['logement_id']; ?>" class="btn btn-primary btn-lg btn-block" style="color: aliceblue;">
                        <?php echo htmlspecialchars($logement['logement_id']); ?>
                    </a>
                </button>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucun logement trouvé.</p>
    <?php endif; ?>
    </div>
</div>

<?php
include '../client_footer.php';