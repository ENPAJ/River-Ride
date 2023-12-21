<?php
$title= "Détails du Pack";

// Inclure le fichier de connexion à la base de données
require_once '../db.php';

// Vérifier si l'ID du pack a été fourni dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pack_id = $_GET['id'];

    // Récupérer les détails du pack depuis la base de données en utilisant $pack_id
    $sql = "SELECT * FROM packs WHERE pack_id = :pack_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pack_id', $pack_id, PDO::PARAM_INT);
    $stmt->execute();
    $pack = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pack) {
        // Rediriger ou afficher un message d'erreur si le pack n'est pas trouvé
        header('Location: client_lister_pack.php'); // Redirige vers la liste des packs
        exit();
    }

    // Récupérer les étapes du pack depuis la base de données
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
    // Rediriger si l'ID du pack n'est pas présent dans l'URL
    header('Location: client_lister_pack.php'); // Redirige vers la liste des packs
    exit();
}

// Traiter le formulaire de commande s'il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Simuler une fonction de choix de packs
    function choisirPack($client_id, $pack_id, $date_debut, $date_fin) {
        // Ici, vous pouvez mettre votre logique de traitement de la commande
        // et retourner true si la commande est réussie, sinon false
        return true;
    }

        $client_id = $_SESSION['client_id'];
        $result = choisirPack($client_id, $pack_id, $date_debut, $date_fin);

        if ($result) {
            // Rediriger après avoir traité la commande
            header('Location: confirmation_commande_pack.php'); // Redirige vers la confirmation de commande
            exit();
        } else {
            // Gérer l'échec de la commande (afficher un message d'erreur, enregistrer dans un journal, etc.)
            $error_message = "La commande a échoué. Veuillez réessayer plus tard.";
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
