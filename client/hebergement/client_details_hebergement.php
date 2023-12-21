
<?php
$title = "Details hebergement";
include '../client_head.php';
include '../client_navbar.php';

// Vérifier si l'ID de l'hébergement a été fourni dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $hebergement_id = $_GET['id'];

    // Récupérer les détails de l'hébergement depuis la base de données en utilisant $hebergement_id
    $sql = "SELECT * FROM hebergement WHERE hebergement_id = :hebergement_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hebergement_id', $hebergement_id, PDO::PARAM_INT);
    $stmt->execute();
    $hebergement = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$hebergement) {
        // Rediriger ou afficher un message d'erreur si l'hébergement n'est pas trouvé
        header('Location: admin_afficher_hebergement.php'); // Redirige vers la liste des hébergements
        exit();
    }
} else {
    // Rediriger si l'ID de l'hébergement n'est pas présent dans l'URL
    header('Location: admin_afficher_hebergement.php'); // Redirige vers la liste des hébergements
    exit();
}
?>

    <main class="main-content position-relative border-radius-lg 
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div>
                                <h3 style="color: black;">Détails de l'hébergement</h3>
                                </div>
                                <div>
                                    <h4>Nom: <?php echo $hebergement['nom']; ?></h4>
                                    <p>Description: <?php echo $hebergement['description']; ?></p>
                                    <p>Capacité maximum: <?php echo $hebergement['capacite_max']; ?></p>
                                    <p>Statut: <?php echo $hebergement['statut']; ?></p>
                                    <p>Point d'arrêt: <?php echo $hebergement['point_arret_id']; ?></p>
                                    <img src="<?php echo $hebergement['photo']; ?>" alt="Photo de l'hébergement">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include '../client_footer.php'; ?>
