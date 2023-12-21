<?php
// admin_creer_etape.php

include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['itineraire_id'], $_POST['point_arret_id'], $_POST['date_etape'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $itineraire_id = htmlspecialchars($_POST['itineraire_id']);
        $point_arret_id = floatval($_POST['point_arret_id']);
        $date_etape = htmlspecialchars($_POST['date_etape']);
    
        try {
                // Code pour insérer les données du etape dans la base de données
                $sql = "INSERT INTO etape (nom, itineraire_id, point_arret_id, date_etape) VALUES (:nom, :itineraire_id, :point_arret_id, :date_etape)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':itineraire_id', $description, PDO::PARAM_STR);
                $stmt->bindParam(':point_arret_id', $capacite_max, PDO::PARAM_INT);
                $stmt->bindParam(':date_etape', $statut, PDO::PARAM_STR);
                $stmt->execute();

                header("Location: admin_afficher_etape.php");
                exit();

            } catch (PDOException $e) {
                // ...
                $message = "Une erreur est survenue lors de la création du etape : " . $e->getMessage();
                $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer etape</title>
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
                                <h3 style="color: black;">Créer etape</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_etape.php">Liste des etapes</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="etapeForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Nom" name="nom">
                                        </div>
                                        <div class="col">
                                        <input type="date" class="form-control" placeholder="Date" name="date_etape">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="itineraire_id">itineraire</label>
                                        <select class="form-control" id="itineraire" name="itineraire_id">
                                        <?php
                                            // Fetch data from the 'itineraire' table to populate the dropdown options
                                            $sql = "SELECT itineraire_id FROM itineraire";
                                            $stmt = $conn->query($sql);
                                            $itineraires = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($itineraires as $itineraire) {
                                                echo "<option value='{$itineraire['itineraire_id']}'>{$itineraire['itineraire_id']}</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="point_arret_id">Point d'arret</label>
                                        <select class="form-control" id="pointarret" name="point_arret_id">
                                        <?php
                                            // Fetch data from the 'pointarret' table to populate the dropdown options
                                            $sql = "SELECT point_arret_id, nom FROM pointarret";
                                            $stmt = $conn->query($sql);
                                            $pointarrets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($pointarrets as $pointarret) {
                                                echo "<option value='{$pointarret['point_arret_id']}'>{$pointarret['nom']}</option>";
                                            }
                                        ?>
                                        </select>
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
    document.getElementById("etapeForm").reset();
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
