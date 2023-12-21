<?php
require_once '../db.php';
?>

<?php
$title = 'Confirmation pack';
include '../client_head.php';
include '../client_navbar.php';
?>

<!-- Contact Start -->
<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Confirmation de Commande</h4>
        <p>Félicitations ! <br>Merci d'avoir commandé le pack !<br>Votre paiement a été correctement effectué.<br>Nous avons bien reçu votre commande. Vous recevrez bientôt un email de confirmation avec les détails.</p>
        <hr>
        <p class="mb-0">
            <a href="client_lister_pack.php">Retourner à la liste des packs</a>
        </p>
    </div>
</div>

<?php
include '../client_footer.php';
?>
