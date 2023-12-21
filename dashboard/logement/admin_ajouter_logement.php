<?php
include '../dashboard_head.php';
require_once '../db.php';

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['chambre'], $_POST['douche'], $_POST['statut'], $_POST['prix'], $_POST['capacite'], $_POST['description'], $_POST['hebergement_id'])) {
        $chambre = intval($_POST['chambre']);
        $douche = intval($_POST['douche']);
        $statut = htmlspecialchars($_POST['statut']);
        $prix = intval($_POST['prix']);
        $capacite = floatval($_POST['capacite']);
        $description = htmlspecialchars($_POST['description']);
        $hebergement_id = htmlspecialchars($_POST['hebergement_id']);
        
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
                // Code pour insérer le logement dans la base de données
                $sql = "INSERT INTO Logement (chambre, douche, statut,  prix, photo, capacite, description, hebergement_id) 
                        VALUES (:chambre, :douche, :statut,  :prix, :photo, :capacite, :description, :hebergement_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':chambre', $chambre, PDO::PARAM_INT);
                $stmt->bindParam(':douche', $douche, PDO::PARAM_INT);
                $stmt->bindParam(':statut', $statut);
                $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
                $stmt->bindParam(':photo', $image_path);
                $stmt->bindParam(':capacite', $capacite, PDO::PARAM_INT);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_STR);
                $stmt->execute();

                header("Location: admin_afficher_logement.php");
                exit();

            } catch (PDOException $e) {
                    // ...
                    $message = "Une erreur est survenue lors de la création du logement : " . $e->getMessage();
                    $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer logement</title>
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
                                <h3 style="color: black;">Créer logement</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_logement.php">Liste des logements</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="logementForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Chambre" id="chambre" name="chambre">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Douche" id="douche" name="douche">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="statut">Statut</label>
                                        <select class="form-control" id="statut" name="statut">
                                            <option value="disponible">Disponible</option>
                                            <option value="indisponible">Indisponible</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Prix" id="prix" name="prix">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Capacite" id="capacite" name="capacite">
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photos</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" placeholder="description" id="description" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="hebergement">Hebergement</label>
                                        <select class="form-control" id="hebergement" name="hebergement_id">
                                        <?php
                                            // Fetch data from the 'hebergement' table to populate the dropdown options
                                            $sql = "SELECT hebergement_id, nom FROM hebergement";
                                            $stmt = $conn->query($sql);
                                            $hebergements = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($hebergements as $hebergement) {
                                                echo "<option value='{$hebergement['hebergement_id']}'>{$hebergement['nom']}</option>";
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
    document.getElementById("logementForm").reset();
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
