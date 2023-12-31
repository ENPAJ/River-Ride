  <!--  start dashboard_head.php   -->
  <?php
  include '../dashboard_head.php';
  require_once '../db.php';

  ?>  
  <!--  end dashboard_head.php   -->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    $sql = "SELECT client_id, nom, prenom, email FROM Clients";
    $stmt = $conn->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Lister Client</title>
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
        <!--  start dashboard_leftnav.php   -->
        <!--  end dashboard_leftnav.php   -->

        <!--  Alert suppression reussi   -->
        <!-- ... -->

        <?php
        if (isset($_GET['suppression_reussie']) && $_GET['suppression_reussie'] === 'true') {
            echo '<div class="alert alert-danger" role="alert" id="suppression-alert">
                    Client supprimé avec succès !
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
                                                <h3>Liste des clients</h3>
                                                <button type="button" class="btn btn-warning" style="background:yellow; color:black;">
                                                    <a href="admin_ajouter_client.php">Ajouter un nouveau client</a>
                                                </button>
                                            </div>

                                            <tr style="text-align: center; color:black; text-decoration:solid;">
                                                <th scope="col">#</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Prenom</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $numero = 1; // Initialisez la variable du numéro
                                                foreach ($clients as $client) :
                                            ?>
                                            <tr class="align-middle">
                                                <td><?php echo $numero++; ?></td>
                                                <td><?php echo htmlspecialchars($client['nom']); ?></td>
                                                <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                                                <td><?php echo htmlspecialchars($client['email']); ?></td>
                                                <td>
                                                    <button type="submit" class="btn btn-info btn-lg"><a href="admin_modifier_client.php?id=<?php echo $client['client_id']; ?>">Modifier</a></button>
                                                    <button type="button" class="btn btn-warning btn-lg">
                                                        <a href="admin_supprimer_client.php?id=<?php echo $client['client_id']; ?>" class="btn-supprimer" onclick="confirmerSuppression(this)">Supprimer</a>
                                                    </button>
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
            <!-- NAV CONTENT -->
        </main>

            <!-- ... -->
    <script>
        // Fonction de confirmation de suppression
        function confirmerSuppression(lien) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce client ?")) {
                // Rediriger vers admin_supprimer_client.php pour la suppression
                window.location.href = lien.getAttribute('href');
            } else {
                // Rediriger vers admin_afficher_client.php si l'admin annule
                window.location.href = 'admin_afficher_client.php';
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