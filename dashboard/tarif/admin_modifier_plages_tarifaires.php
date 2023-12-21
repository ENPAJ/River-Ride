<!-- admin_modifier_plage_tarifaire.php -->
<?php
// Inclure les fichiers nécessaires
include '../dashboard_head.php';
require_once '../db.php';

// Initialiser les variables
$id = '';
$nom = '';
$dateDebut = '';
$dateFin = '';
$tarif = '';
$description = '';
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    // Récupérer les données de la plage tarifaire depuis la base de données
    $sql = "SELECT * FROM Tarification WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Mettre à jour les variables avec les données existantes
    if ($row) {
        $nom = $row['nom'];
        $dateDebut = $row['date_debut'];
        $dateFin = $row['date_fin'];
        $tarif = $row['tarif'];
        $description = $row['description'];
    } else {
        $errorMessage = "Plage tarifaire non trouvée.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];
    $tarif = floatval($_POST['tarif']);
    $description = $_POST['description'];

    // Valider et traiter les données
    if (empty($nom) || empty($dateDebut) || empty($dateFin) || $tarif <= 0) {
        $errorMessage = "Veuillez remplir tous les champs correctement.";
    } else {
        // Mettre à jour les données dans la base de données
        try {
            $sql = "UPDATE Tarification SET nom = ?, date_debut = ?, date_fin = ?, tarif = ?, description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nom, PDO::PARAM_STR);
            $stmt->bindParam(2, $dateDebut, PDO::PARAM_STR);
            $stmt->bindParam(3, $dateFin, PDO::PARAM_STR);
            $stmt->bindParam(4, $tarif, PDO::PARAM_STR);
            $stmt->bindParam(5, $description, PDO::PARAM_STR);
            $stmt->bindParam(6, $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $successMessage = "Plage tarifaire mise à jour avec succès.";
            } else {
                $errorMessage = "Une erreur est survenue lors de la mise à jour de la plage tarifaire.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Erreur PDO : " . $e->getMessage();
        }
    }
}
?>

<!-- ... Autres éléments d'en-tête et de navigation ... -->

<main class="main-content position-relative border-radius-lg">
    <?php include '../dashboard_mainnav.php'; ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3>Modifier une Plage Tarifaire</h3>
                        <?php if ($successMessage) : ?>
                            <p style="color: green;"><?php echo $successMessage; ?></p>
                        <?php endif; ?>
                        <?php if ($errorMessage) : ?>
                            <p style="color: red;"><?php echo $errorMessage; ?></p>
                        <?php endif; ?>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div>
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>
                            </div>
                            <div>
                                <label for="date_debut">Date de début :</label>
                                <input type="date" name="date_debut" value="<?php echo $dateDebut; ?>" required>
                            </div>
                            <div>
                                <label for="date_fin">Date de fin :</label>
                                <input type="date" name="date_fin" value="<?php echo $dateFin; ?>" required>
                            </div>
                            <div>
                                <label for="tarif">Tarif :</label>
                                <input type="number" step="0.01" name="tarif" value="<?php echo $tarif; ?>" required>
                            </div>
                            <div>
                                <label for="description">Description :</label>
                                <textarea name="description"><?php echo htmlspecialchars($description); ?></textarea>
                            </div>
                            <div>
                                <button type="submit">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ... Autres éléments de pied de page et de configuration ... -->
