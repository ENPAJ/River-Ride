<?php
session_start();
$title = "Détails du Pack";

require_once '../db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pack_id = $_GET['id'];

    $sql = "SELECT * FROM packs WHERE pack_id = :pack_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pack_id', $pack_id, PDO::PARAM_INT);
    $stmt->execute();
    $pack = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pack) {
        header('Location: client_lister_pack.php');
        exit();
    }

    $sqlEtapes = "SELECT pe.pack_etape_id, pa.nom AS point_arret_nom, pk.nom AS pack_nom, h.nom AS hebergement_nom, pe.ordre_etape, pe.logement_id
                  FROM pack_etape AS pe
                  JOIN pointarret AS pa ON pe.point_arret_id = pa.point_arret_id
                  JOIN packs AS pk ON pe.pack_id = pk.pack_id
                  JOIN hebergement AS h ON pe.hebergement_id = h.hebergement_id
                  WHERE pe.pack_id = :pack_id";
    $stmtEtapes = $conn->prepare($sqlEtapes);
    $stmtEtapes->bindParam(':pack_id', $pack_id, PDO::PARAM_INT);
    $stmtEtapes->execute();
    $pack_etape = $stmtEtapes->fetchAll(PDO::FETCH_ASSOC);
} else {
    header('Location: client_lister_pack.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['client_id'];
    $pack_id = $_POST["pack_id"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];

    $sql = "INSERT INTO choix_packs (client_id, pack_id, date_debut, date_fin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$client_id, $pack_id, $date_debut, $date_fin]);

    header('Location: confirmation_commande_pack.php');
    exit();
}
?>

<?php
include '../client_head.php';
include '../client_navbar.php';
?>

<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Détails du Pack</h4>
        <p>Nom du Pack : <?php echo $pack['nom']; ?></p>
        <p>Description du Pack : <?php echo $pack['description']; ?></p>
        <p>Prix du Pack : <?php echo $pack['prix']; ?></p>
        <hr>
        <?php foreach ($pack_etape as $pack_etapeItem): ?>
            <p>Ordre : <?php echo $pack_etapeItem['ordre_etape']; ?></p>
            <p>Point d'arrêt : <?php echo $pack_etapeItem['point_arret_nom']; ?></p>
            <p>Hébergement : <?php echo $pack_etapeItem['hebergement_nom']; ?></p>
            <hr>
        <?php endforeach; ?>

        <form method="post" action="">
            <input type="hidden" name="pack_id" value="<?php echo $pack_id; ?>">
            <label for="date_debut">Date de Début :</label>
            <input type="date" id="date_debut" name="date_debut" required><br>

            <label for="date_fin">Date de Fin :</label>
            <input type="date" id="date_fin" name="date_fin" required><br>

            <button type="submit" class="btn btn-primary btn-lg">Commander ce Pack</button>
        </form>
    </div>
</div>

<?php
include '../client_footer.php';
?>
