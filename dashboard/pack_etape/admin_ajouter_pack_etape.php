<?php
include '../dashboard_head.php';
require_once '../db.php';

$message = "";
$alertClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pack_id'], $_POST['point_arret_id'], $_POST['hebergement_id'], $_POST['logement_id'], $_POST['ordre_etape'])) {
        $pack_id = htmlspecialchars($_POST['pack_id']);
        $point_arret_id = htmlspecialchars($_POST['point_arret_id']);
        $hebergement_id = htmlspecialchars($_POST['hebergement_id']);
        $logement_id = htmlspecialchars($_POST['logement_id']);
        $ordre_etape = floatval($_POST['ordre_etape']);

        try {
            $sql = "INSERT INTO pack_etape (pack_id, point_arret_id, hebergement_id, logement_id, ordre_etape) VALUES (:pack_id, :point_arret_id, :hebergement_id, :logement_id, :ordre_etape)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pack_id', $pack_id, PDO::PARAM_STR);
            $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_STR);
            $stmt->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_STR);
            $stmt->bindParam(':logement_id', $logement_id, PDO::PARAM_STR);
            $stmt->bindParam(':ordre_etape', $ordre_etape, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: admin_afficher_pack_etape.php");
            exit();
        } catch (PDOException $e) {
            $message = "Une erreur est survenue lors de la création du pack_etape : " . $e->getMessage();
            $alertClass = "alert alert-danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer Pack_Etape</title>
</head>
<body class="g-sidenav-show bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
        <?php include '../dashboard_mainnav.php'; ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div>
                                <h3 style="color: black;">Créer Pack_Etape</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_pack_etape.php">Liste des Pack_Etape</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="packetapeForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                <div class="form-group">
                                    <label for="packs">Packs inclus :</label>
                                    <select class="form-control" id="packs" name="pack_id">
                                        <?php
                                        // Code pour récupérer la liste des itinéraires depuis la base de données
                                        try {
                                            // Requête pour récupérer la liste des packs depuis la base de données
                                            $sql_packs = "SELECT pack_id, nom FROM packs";
                                            $stmt_packs = $conn->query($sql_packs);
                                            $packs = $stmt_packs->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            // Afficher les options du select avec les packs disponibles
                                            foreach ($packs as $packsItem) {
                                                echo "<option value='" . $packsItem['pack_id'] . "'>" . htmlspecialchars($packsItem['nom']) . "</option>";
                                            }
                                        } catch (PDOException $e) {
                                            // Gérer les erreurs PDO
                                            // ...
                                        }
                                        ?>
                                    </select><br>
                                </div>

                                <div class="form-group">
                                    <label for="ordre_etape">ordre_etape :</label>
                                    <input type="text" name="ordre_etape" required><br>

                                    <label for="point_arret_id">point d'arret inclus:</label>
                                    <select class="form-control" id="point_arret" name="point_arret_id">
                                        <?php
                                        // Code pour récupérer la liste des points d'arrêt depuis la base de données
                                        try {
                                            // Requête pour récupérer la liste des points d'arrêt depuis la base de données
                                            $sql_point_arret = "SELECT point_arret_id, nom FROM pointarret";
                                            $stmt_point_arret = $conn->query($sql_point_arret);
                                            $point_arret = $stmt_point_arret->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            // Afficher les options du select avec les points d'arrêt disponibles
                                            foreach ($point_arret as $point_arretItem) {
                                                echo "<option value='" . $point_arretItem['point_arret_id'] . "'>" . htmlspecialchars($point_arretItem['nom']) . "</option>";
                                            }
                                        } catch (PDOException $e) {
                                            // Gérer les erreurs PDO
                                            // ...
                                        }
                                        ?>
                                    </select><br>
                                </div>

                                <div class="form-group">
                                    <label for="hebergement_id">Hébergements inclus :</label>
                                    <select class="form-control" id="Hebergement" name="hebergement_id">
                                        <?php
                                        // Code pour récupérer la liste des hébergements depuis la base de données
                                        try {
                                            // Requête pour récupérer la liste des hébergements depuis la base de données
                                            $sql_hebergements = "SELECT hebergement_id, nom FROM hebergement";
                                            $stmt_hebergements = $conn->query($sql_hebergements);
                                            $hebergements = $stmt_hebergements->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            // Afficher les options du select avec les hébergements disponibles
                                            foreach ($hebergements as $hebergement) {
                                                echo "<option value='" . $hebergement['hebergement_id'] . "'>" . htmlspecialchars($hebergement['nom']) . "</option>";
                                            }
                                        } catch (PDOException $e) {
                                            // Gérer les erreurs PDO
                                            // ...
                                        }
                                        ?>
                                    </select><br>
                                </div>

                                <div class="form-group">
                                    <label for="logement_id">Logement inclus :</label>
                                    <select class="form-control" id="logement" name="logement_id">
                                        <?php
                                        // Code pour récupérer la liste des logements depuis la base de données
                                        try {
                                            // Requête pour récupérer la liste des logements depuis la base de données
                                            $sql_logement = "SELECT logement_id FROM logement";
                                            $stmt_logement = $conn->query($sql_logement);
                                            $logements = $stmt_logement->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            // Afficher les options du select avec les logements disponibles
                                            foreach ($logements as $logementItem) {
                                                echo "<option value='" . $logementItem['logement_id'] . "'>" . htmlspecialchars($logementItem['logement_id']) . "</option>";
                                            }
                                        } catch (PDOException $e) {
                                            // Gérer les erreurs PDO
                                            // ...
                                        }
                                        ?>
                                    </select><br>
                                </div>
                                    <div style="align-self: center; margin:10px;">
                                        <button type="submit" class="btn btn-success btn-lg">Créer</button>
                                        <button type="button" class="btn btn-secondary btn-lg" onclick="annuler()">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<!-- Reste de votre code HTML ... -->
<script>
function annuler() {
    document.getElementById("packetapeForm").reset();
}

// Masquer l'alerte après un délai (en millisecondes)
setTimeout(function() {
    var alertMessage = document.getElementById("alertMessage");
    if (alertMessage) {
        alertMessage.style.display = "none";
    }
}, 5000); // 5000 millisecondes (5 secondes)
</script>
<!-- Reste de votre code JavaScript ... -->

</body>
</html>
