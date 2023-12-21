<!-- admin_gestion_codes_promo.php -->
<?php

include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

// Traitement du formulaire de création de code promo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $code_promo = $_POST["code_promo"];
    $duree = $_POST["duree"];
    include '../db.php';

    // Valider les données et les insérer dans la base de données
        // ...

        try {
            // ...

            // Code pour insérer les données du codepromo dans la base de données
            $sql = "INSERT INTO codepromo (code_promo, duree) VALUES (:code_promo, :duree)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':code_promo', $code_promo, PDO::PARAM_STR);
            $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: admin_afficher_codes_promo.php");
            exit();


        } catch (PDOException $e) {
            // ...
            $message = "Une erreur est survenue lors de la création du Code Promo : " . $e->getMessage();
            $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
        }
}


// Afficher la liste des codes promo existants
// ...

?>

<!-- Formulaire de création de code promo -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer CodePromo</title>
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
                            <h3 style="color: black;">Créer un nouveau code promo</h3>
                            <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="codepromoForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="form-group">
                                        <label for="code_promo">Code Promo:</label>
                                        <input type="text" class="form-control" id="code_promo" placeholder="Description" name="code_promo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="duree">Durée de validité en jours:</label>
                                        <input type="number" class="form-control" id="duree" name="duree">
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
    document.getElementById("codepromoForm").reset();
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
