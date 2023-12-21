<?php
// Inclure le fichier de connexion à la base de données
require_once '../db.php';
$title = "Liste des Packs";

// Récupérer la liste des packs depuis la base de données
$sql = "SELECT * FROM packs";
$stmt = $conn->query($sql);
$packs = $stmt->fetchAll(PDO::FETCH_ASSOC);


include '../client_head.php';
include '../client_navbar.php';
?>

<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Liste des Packs</h4>
        <ul>
            <?php foreach ($packs as $pack) : ?>
                <button type="button" class="btn btn-primary btn-lg btn-block">
                    <a style="color:aliceblue;" href="client_afficher_details_pack.php?id=<?php echo $pack['pack_id']; ?>">
                        <?php echo $pack['nom']; ?>
                    </a>
                </button>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


<?php
include '../client_footer.php';
?>
