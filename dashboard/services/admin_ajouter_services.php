<!-- admin_ajouter_service.php -->
<?php
include '../dashboard_head.php';
require_once '../db.php';

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $cout = floatval($_POST['cout']);

    try {
        // Insérer le nouveau service dans la base de données
        $sql = "INSERT INTO Services (nom, description, cout) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->bindParam(2, $description, PDO::PARAM_STR);
        $stmt->bindParam(3, $cout, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Rediriger vers la page d'affichage des services après la création
            header("Location: admin_afficher_services.php");
            exit();
        } else {
            $message = "Une erreur est survenue lors de la création du service. Veuillez réessayer.";
            $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
        }

    } catch (PDOException $e) {
        $message = "Une erreur est survenue lors de la création du service : " . $e->getMessage();
        $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Service</title>
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
                                <h3 style="color: black;">Créer Service</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_service.php">Liste des services</a>
                                    </button>
                                </div>

                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="servicesForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="row">
                                        <label for="nom">Nom :</label>
                                        <input type="text" name="nom" required><br>
                                    </div>
                                    <div class="row">
                                        <label for="description">Description :</label>
                                        <textarea name="description" required></textarea><br>
                                    </div>
                                    <div class="row">
                                        <label for="cout">Coût :</label>
                                        <input type="number" step="0.01" name="cout" required><br>
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
    <script>
        function annuler() {
            document.getElementById("servicesForm").reset();
        }

        // Masquer l'alerte après un délai (en millisecondes)
        setTimeout(function() {
            var alertMessage = document.getElementById("alertMessage");
            if (alertMessage) {
                alertMessage.style.display = "none";
            }
        }, 5000); // 5000 millisecondes (5 secondes)
    </script>
</body>
</html>
