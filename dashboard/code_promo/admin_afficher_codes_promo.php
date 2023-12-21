<!-- admin_afficher_codes_promo.php -->
<?php
  include '../dashboard_head.php';
  require_once '../db.php';
?>  
  <!--  end dashboard_head.php   -->

<!-- Code pour vérifier l'authentification de l'admin ici... -->

<!-- Inclure le fichier db.php pour la connexion à la base de données -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

// Récupérer la liste de tous les codes promo
$sql = "SELECT * FROM CodePromo";
$stmt = $conn->query($sql);
$codepromo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Codes Promo</title>
    <style>
        .table img {
            max-width: 100px;
            max-height: 100px;
        }
        .table td {
            text-align: center;
        }
    </style>
</head>
<body class="g-sidenav-showbg- gray-100">
        
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
            <!--  Alert suppression reussi   -->
            <!-- ... -->
    
            <?php
            if (isset($_GET['suppression_reussie']) && $_GET['suppression_reussie'] === 'true') {
                echo '<div class="alert alert-danger" role="alert" id="suppression-alert">
                        codepromo supprimé avec succès !
                    </div>';
            }
            ?>
    
            <main class="main-content position-relative border-radius-lg ">
                <!--  start dashboard_main.php   -->
                <?php include '../dashboard_mainnav.php'; ?>
                <!--  start dashboard_main.php   -->
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table mb-0">
                                            <thead>
                                                <div>
                                                    <h3>Liste des codes promo</h3>
                                                    <button type="button" class="btn btn-warning" style="background:yellow; color:black;">
                                                        <a href="admin_gestion_codes_promo.php">Ajouter un nouveau codepromo</a>
                                                    </button>
                                                </div>

                                                <tr style="text-align: center; color:black; text-decoration:solid;">
            <th scope="col">ID</th>
            <th scope="col">Code Promo</th>
            <th scope="col">Durée (jours)</th>
            <th scope="col">Date de Création</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $numero = 1; // Initialisez la variable du numéro
                foreach ($codepromo as $codepromos) :
            ?>
            <tr class="align-middle">
                <td><?php echo $numero++; ?></td>
                <td><?php echo $codepromos['code_promo']; ?></td>
                <td><?php echo $codepromos['duree']; ?></td>
                <td><?php echo $codepromos['date_creation']; ?></td>
                <td>
                    <!-- Lien pour supprimer le code promo -->
                    <button type="submit" class="btn btn-info btn-lg"><a href="admin_modifier_codepromo.php?id=<?php echo $codepromos['codepromo_id']; ?>">Modifier</a></button>
                    <button type="button" class="btn btn-warning btn-lg">
                        <a href="admin_supprimer_code_promo.php?id=<?php echo $codepromos['codepromo_id']; ?>" class="btn-supprimer" onclick="confirmerSuppression(this)">Supprimer</a>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
