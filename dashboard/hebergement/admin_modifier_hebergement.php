<?php
// admin_modifier_hebergement.php

include '../dashboard_head.php';
require_once '../db.php';

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['hebergement_id'], $_POST['nom'], $_POST['description'], $_POST['capacite_max'], $_POST['statut'], $_POST['point_arret_id'])) {
        $hebergement_id = htmlspecialchars($_POST['hebergement_id']);
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $capacite_max = floatval($_POST['capacite_max']);
        $statut = htmlspecialchars($_POST['statut']);
        $point_arret_id = htmlspecialchars($_POST['point_arret_id']);

        // Code pour mettre à jour les données de l'hébergement dans la base de données
        $sql = "UPDATE hebergement SET nom = :nom, description = :description, capacite_max = :capacite_max, statut = :statut, point_arret_id = :point_arret_id WHERE hebergement_id = :hebergement_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':capacite_max', $capacite_max, PDO::PARAM_INT);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header("Location: admin_afficher_hebergement.php");
            exit();
        } else {
            $message = "Une erreur est survenue lors de la mise à jour de l'hébergement.";
            $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
        }
    }
} else {
    // Obtenir les détails de l'hébergement à partir de l'ID passé dans l'URL
    if (isset($_GET['id'])) {
        $hebergement_id = $_GET['id'];

        // Code pour récupérer les détails de l'hébergement à partir de la base de données
        $sql = "SELECT * FROM hebergement WHERE hebergement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$hebergement_id]);
        $hebergement = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si l'ID n'est pas spécifié dans l'URL, rediriger vers admin_afficher_hebergement.php
        header("Location: admin_afficher_hebergement.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier Hébergement</title>
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
                                    <h3 style="color: black;">Modifier Hébergement</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_hebergement.php">Liste des hébergements</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="hebergementForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <input type="hidden" name="hebergement_id" value="<?php echo $hebergement['hebergement_id']; ?>">
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php echo htmlspecialchars($hebergement['nom']); ?>">
                                        </div>
                                        <div class="col">
                                        <textarea type="text" class="form-control" placeholder="Description" name="description"><?php echo htmlspecialchars($hebergement['description']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Capacite maximum" id="capacite_max" name="capacite_max" value="<?php echo htmlspecialchars($hebergement['capacite_max']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pointarret">Point d'arret</label>
                                        <select class="form-control" id="pointarret" name="point_arret_id">
                                        <?php
                                            // Fetch data from the 'pointarret' table to populate the dropdown options
                                            $sql = "SELECT point_arret_id, nom FROM pointarret";
                                            $stmt = $conn->query($sql);
                                            $pointarrets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($pointarrets as $pointarret) {
                                                $selected = ($pointarret['point_arret_id'] === $hebergement['point_arret_id']) ? 'selected' : '';
                                                echo "<option value='{$pointarret['point_arret_id']}' $selected>{$pointarret['nom']}</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="statut">Statut</label>
                                        <select class="form-control" id="statut" name="statut">
                                            <option value="ouvert" <?php echo ($hebergement['statut'] === 'ouvert') ? 'selected' : ''; ?>>Ouvert</option>
                                            <option value="ferme" <?php echo ($hebergement['statut'] === 'ferme') ? 'selected' : ''; ?>>Fermé</option>
                                        </select>
                                    </div>
                                    <div style="align-self: center; margin:10px;">
                                        <button type="submit" class="btn btn-success btn-lg">Mettre à jour</button>
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
    document.getElementById("hebergementForm").reset();
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
