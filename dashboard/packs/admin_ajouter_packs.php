<?php
// admin_creer_packs.php

include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'], $_POST['description'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);

        try {
            // Code pour insérer les données du packs dans la base de données
            $sql = "INSERT INTO packs (nom, description) VALUES (:nom, :description)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: admin_afficher_packs.php");
            exit();

        } catch (PDOException $e) {
            // ...
            $message = "Une erreur est survenue lors de la création du packs : " . $e->getMessage();
            $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
        }
    }
}

?>


        <!-- admin_creer_pack.php -->
        <!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer packs</title>
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
                                <h3 style="color: black;">Créer packs</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_packs.php">Liste des packss</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                    <form id="packsForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                        <div class="col">
                                            <label for="nom">Nom</label>
                                            <input type="text" name="nom" required><br>

                                            <label for="description">Description :</label>
                                            <textarea type="text" class="form-control" placeholder="Description" name="description"></textarea>
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
    document.getElementById("packsForm").reset();
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
