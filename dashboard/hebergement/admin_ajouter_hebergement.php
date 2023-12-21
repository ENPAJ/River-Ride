<?php
// admin_creer_hebergement.php

include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'], $_POST['description'], $_POST['capacite_max'], $_POST['statut'], $_POST['point_arret_id'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $capacite_max = floatval($_POST['capacite_max']);
        $statut = htmlspecialchars($_POST['statut']);
        $point_arret_id = htmlspecialchars($_POST['point_arret_id']);
    
        // Create a folder to store images if it doesn't exist
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = $_FILES['photo']['tmp_name'];
            $image_name = $_FILES['photo']['name'];
            $image_path = $uploadDir . $image_name;
        
            // Move the uploaded image to the server's file system
            move_uploaded_file($image_tmp, $image_path);

        try {
                // Code pour insérer les données du hebergement dans la base de données
                $sql = "INSERT INTO hebergement (nom, description, capacite_max, photo, statut, point_arret_id) VALUES (:nom, :description, :capacite_max, :photo, :statut, :point_arret_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);
                $stmt->bindParam(':capacite_max', $capacite_max, PDO::PARAM_INT);
                $stmt->bindParam(':photo', $image_path);
                $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
                $stmt->bindParam(':point_arret_id', $point_arret_id, PDO::PARAM_STR);
                $stmt->execute();

                header("Location: admin_afficher_hebergement.php");
                exit();

            } catch (PDOException $e) {
                // ...
                $message = "Une erreur est survenue lors de la création du hebergement : " . $e->getMessage();
                $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer hebergement</title>
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
                                <h3 style="color: black;">Créer hebergement</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_hebergement.php">Liste des hebergements</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="hebergementForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Nom" name="nom">
                                        </div>
                                        <div class="col">
                                        <textarea type="text" class="form-control" placeholder="Description" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Capacite maximum" id="capacite_max" name="capacite_max">
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
                                                echo "<option value='{$pointarret['point_arret_id']}'>{$pointarret['nom']}</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="statut">Statut</label>
                                        <select class="form-control" id="statut" name="statut">
                                            <option value="ouvert">Ouvert</option>
                                            <option value="ferme">Fermé</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photos</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
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
