<?php
require_once '../db.php';
$title = "Confirmation de Réservation";
include '../client_head.php';
include '../client_navbar.php';


// Récupérer les données du formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logementId = $_POST['logement_id'];
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];
    
    // Vous pouvez maintenant insérer ces données dans la base de données ou les traiter comme nécessaire
    // ...

    // Par exemple, afficher un message de confirmation
    $confirmationMessage = "Votre réservation a été confirmée pour le logement ID $logementId";
}
?>

<!-- Contact Start -->
<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="alert alert-success" role="alert">
        <?php if (isset($confirmationMessage)) : ?>
            <h2 class="alert-heading">Confirmation de Réservation</h2>
            <p><?php echo $confirmationMessage; ?></p><hr>
            <p>Du <?php echo $dateDebut; ?></p>
            <p>Au <?php echo $dateFin; ?></p>

        <?php else : ?>
            <p>Une erreur est survenue lors de la réservation.</p>
        <?php endif; ?>

        <!-- Lien pour revenir à la page d'accueil ou autre page -->
        <a href="../index.php">Retour à l'Accueil</a>
    </div>
</div>

<?php
include '../client_footer.php';
