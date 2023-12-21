<?php
// admin_creer_client.php

include '../dashboard_head.php';
require_once '../db.php';

// Code pour vérifier l'authentification de l'admin ici...
// ...

$message = ""; // Initialiser le message d'information
$alertClass = ""; // Initialiser la classe de l'alerte


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Code pour traiter les données soumises depuis le formulaire de création de client
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mot_de_passe'])) {
        // Connexion à la base de données (vous pouvez inclure le fichier db.php pour la connexion)
        include '../db.php';

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

            try {
                // Code pour insérer les données du client dans la base de données
                $sql = "INSERT INTO Clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mot_de_passe', $mot_de_passe);
                $stmt->execute();

                $message = "Le client a été créé avec succès";
                $alertClass = "alert alert-success"; // Classe de l'alerte de succès

            } catch (PDOException $e) {
                // Gérer les erreurs PDO
                // ...
                $message = "Une erreur est survenue lors de la création du client : " . $e->getMessage();
                $alertClass = "alert alert-danger"; // Classe de l'alerte d'échec
                }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer Client</title>
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
                                <h3 style="color: black;">Créer client</h3>
                                <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_client.php">Liste des clients</a>
                                    </button>
                                </div>
                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="clientForm" method="POST" action="">
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Prenom" name="prenom">
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Nom" name="nom">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                        </div>
                                        <div class="col">
                                        <input type="password" class="form-control" placeholder="Mot de passe" name="mot_de_passe">
                                        </div>
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
    document.getElementById("clientForm").reset();
}

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
