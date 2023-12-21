<!-- admin_afficher_plages_tarifaires.php -->
<?php
// Inclure les fichiers nécessaires
include '../dashboard_head.php';
require_once '../db.php';

// Récupérer les données des plages tarifaires depuis la base de données
$sql = "SELECT * FROM Tarification";
$stmt = $conn->query($sql);
$plages_tarifaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ... Autres éléments d'en-tête et de navigation ... -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Lister tarif</title>
        <style>
        .table img {
            max-width: 100px;
            max-height: 100px;
        }
        .table td {
            text-align: center;
        }
        .badge {
        padding: 6px 12px;
        }
        .badge-success {
            color: #155724; /* Dark green color */
            background-color: #d4edda; /* Light green background */
        }
        .badge-danger {
            color: #721c24; /* Dark red color */
            background-color: #f8d7da; /* Light red background */
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
                    tarif supprimé avec succès !
                </div>';
        }
        ?>
<main class="main-content position-relative border-radius-lg">
    <?php include '../dashboard_mainnav.php'; ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <h3>Liste des Plages Tarifaires</h3>
                            <button type="button" class="btn btn-warning" style="background:yellow; color:black;">
                                <a href="admin_ajouter_tarif.php">Ajouter un nouveau tarif</a>
                            </button>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Date de début</th>
                                        <th>Date de fin</th>
                                        <th>Tarif</th>
                                        <th>Statut</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $numero = 1; // Initialisez la variable du numéro
                                    foreach ($plages_tarifaires as $plage) : ?>
                                         <tr class="align-middle">
                                            <td><?php echo $numero++; ?></td>
                                            <td><?php echo htmlspecialchars($plage['nom']); ?></td>
                                            <td><?php echo $plage['date_debut']; ?></td>
                                            <td><?php echo $plage['date_fin']; ?></td>
                                            <td><?php echo $plage['tarif']; ?></td>
                                            <td><?php 
                                                $actif = $plage['actif'];
                                                $badgeClass = $actif === 'actif' ? 'badge badge-success' : 'badge badge-danger';
                                                echo '<span class="' . $badgeClass . '">' . htmlspecialchars($actif) . '</span>';
                                                ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($plage['description']); ?></td>
                                            <td>
                                                <button type="submit" class="btn btn-info btn-lg"><a href="admin_modifier_tarif.php?id=<?php echo $plage['id']; ?>">Modifier</a></button>
                                                <button type="button" class="btn btn-warning btn-lg">
                                                    <a href="admin_supprimer_tarif.php?id=<?php echo $plage['id']; ?>" class="btn-supprimer" onclick="confirmerSuppression(this)">Supprimer</a>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ... Autres éléments de pied de page et de configuration ... -->

            <!-- ... -->
            <script>
        // Fonction de confirmation de suppression
        function confirmerSuppression(lien) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce tarif ?")) {
                // Rediriger vers admin_supprimer_tarif.php pour la suppression
                window.location.href = lien.getAttribute('href');
            } else {
                // Rediriger vers admin_afficher_tarif.php si l'admin annule
                window.location.href = 'admin_afficher_tarif.php';
            }
        }

        // Fonction pour cacher l'alerte après un certain délai
        function cacherAlerte() {
            var alerte = document.querySelector('.alert');
            if (alerte) {
                setTimeout(function() {
                    alerte.style.display = 'none';
                }, 5000); // 5000 millisecondes = 5 secondes
            }
        }

        // Appeler la fonction lors du chargement de la page
        window.onload = function() {
            cacherAlerte();

            // Attacher la fonction de confirmation aux liens de suppression
            const liensSuppression = document.querySelectorAll('.btn-supprimer');
            liensSuppression.forEach(lien => {
                lien.addEventListener('click', () => {
                    confirmerSuppression(lien);
                });
            });
        };

    </script>


            <!-- ... -->

    <!--  start dashboard_config.php   -->
    <?php include '../dashboard_config.php'; ?>
    <!--  end dashboard_config.php   -->

    <!--  start dashboard_js.php   -->
    <?php include '../dashboard_js.php'; ?>
    <!--  start dashboard_js.php   -->

    </body>

</html>