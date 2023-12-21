<!-- admin_ajouter_plage_tarifaire.php -->
<?php
// Inclure les fichiers nécessaires
include '../dashboard_head.php';
require_once '../db.php';

// Initialiser les variables
$nom = '';
$dateDebut = '';
$dateFin = '';
$tarif = '';
$description = '';
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];
    $tarif = floatval($_POST['tarif']);
    $description = $_POST['description'];

    // Valider et traiter les données
    if (empty($nom) || empty($dateDebut) || empty($dateFin) || $tarif <= 0) {
        $errorMessage = "Veuillez remplir tous les champs correctement.";
    } else {
        // Insérer les données dans la base de données
        try {
            $sql = "INSERT INTO Tarification (nom, date_debut, date_fin, tarif, description) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $dateDebut, PDO::PARAM_STR);
            $stmt->bindParam(3, $dateFin, PDO::PARAM_STR);
            $stmt->bindParam(4, $tarif, PDO::PARAM_STR);
            $stmt->bindParam(5, $description, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $successMessage = "Plage tarifaire créée avec succès.";
                // Réinitialiser les variables
                $nom = '';
                $dateDebut = '';
                $dateFin = '';
                $tarif = '';
                $description = '';
            } else {
                $errorMessage = "Une erreur est survenue lors de la création de la plage tarifaire.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Erreur PDO : " . $e->getMessage();
        }
    }
}
?>

<!-- ... Autres éléments d'en-tête et de navigation ... -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer hebergement</title>
</head>
<body class="g-sidenav-show bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<main class="main-content position-relative border-radius-lg">
    <?php include '../dashboard_mainnav.php'; ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <h3 style="color: black;">Créer une Plage Tarifaire</h3>
                        <button type="button" class="btn btn-warning" style="background:yellow; color:black;">
                            <a href="admin_afficher_tarif.php">Lister Plage Tarifaire</a>
                        </button>
                        <?php if ($successMessage) : ?>
                            <p style="color: green;"><?php echo $successMessage; ?></p>
                        <?php endif; ?>
                        <?php if ($errorMessage) : ?>
                            <p style="color: red;"><?php echo $errorMessage; ?></p>
                        <?php endif; ?>
                        <form id="hebergementForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($nom); ?>" required>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="date_debut">Date de début :</label>
                                    <input type="date" name="date_debut" class="form-control" value="<?php echo $dateDebut; ?>" required>
                                </div>
                                <div class="col">
                                    <label for="date_fin">Date de fin :</label>
                                    <input type="date" name="date_fin" class="form-control" value="<?php echo $dateFin; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tarif">Tarif :</label>
                                <input type="number" step="0.01" name="tarif" class="form-control" value="<?php echo $tarif; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="actif">Statut :</label>
                                <select class="form-control" id="actif" name="actif">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description"><?php echo htmlspecialchars($description); ?></textarea>
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
<!-- ... Autres éléments de pied de page et de configuration ... -->
