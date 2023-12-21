<!--  start dashboard_head.php   -->
<?php
include '../dashboard_head.php';
require_once '../db.php';

// Check if the logement ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_afficher_logement.php");
    exit();
}

$logement_id = $_GET['id'];
$sql = "SELECT * FROM logement WHERE logement_id = :logement_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':logement_id', $logement_id, PDO::PARAM_INT);
$stmt->execute();
$logement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$logement) {
    header("Location: admin_afficher_logement.php");
    exit();
}
?>  
<!--  end dashboard_head.php   -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier Logement</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body class="g-sidenav-showbg- gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
    <main class="main-content position-relative border-radius-lg">
        <?php include '../dashboard_mainnav.php'; ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <form method="POST" action="">
                                    <input type="hidden" name="logement_id" value="<?php echo $logement_id; ?>">
                                    
                                    <label for="chambre">Chambre:</label>
                                    <input type="text" name="chambre" value="<?php echo htmlspecialchars($logement['chambre']); ?>">
                                    
                                    <label for="douche">Douche:</label>
                                    <input type="text" name="douche" value="<?php echo htmlspecialchars($logement['douche']); ?>">
                                    
                                    <label for="statut">Statut:</label>
                                    <select name="statut">
                                        <option value="disponible" <?php if ($logement['statut'] === 'disponible') echo 'selected'; ?>>Disponible</option>
                                        <option value="indisponible" <?php if ($logement['statut'] === 'indisponible') echo 'selected'; ?>>Indisponible</option>
                                    </select>
                                    
                                    <label for="prix">Prix (€):</label>
                                    <input type="number" name="prix" value="<?php echo $logement['prix']; ?>">
                                    
                                    <!-- Add more input fields for other logement properties -->
                                    
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        // Your JavaScript code here
    </script>
    
    <?php include '../dashboard_config.php'; ?>
    <?php include '../dashboard_js.php'; ?>
</body>
</html>
