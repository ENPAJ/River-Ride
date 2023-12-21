<?php
// admin_modifier_client.php

include '../dashboard_head.php';
require_once '../db.php';
include '../dashboard_head.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = "";
$alertClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['client_id'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
        $client_id = htmlspecialchars($_POST['client_id']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);

        try {
            // Code pour mettre à jour les données du client dans la base de données
            $sql = "UPDATE Clients SET nom = :nom, prenom = :prenom, email = :email WHERE client_id = :client_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $stmt->execute();

            $message = "Les informations du client ont été mises à jour avec succès";
            $alertClass = "alert alert-success";

        } catch (PDOException $e) {
            $message = "Une erreur est survenue lors de la mise à jour des informations du client : " . $e->getMessage();
            $alertClass = "alert alert-danger";
        }
    }
}

// Récupérer les informations du client à partir de l'ID (vous devez implémenter cela)
$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : '';
$sql = "SELECT * FROM Clients WHERE client_id = :client_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier Client</title>
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
                                    <h3 style="color: black;">Modifier client</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_client.php">Liste des clients</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="clientForm" method="POST" action="">
                                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Prenom" name="prenom" value="<?php echo $clientInfo['prenom']; ?>">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php echo $clientInfo['nom']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $clientInfo['email']; ?>">
                                        </div>
                                    </div>
                                    <div style="align-self: center; margin:10px;">
                                        <button type="submit" class="btn btn-success btn-lg">Enregistrer</button>
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
    document.getElementById("clientForm").reset();
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
