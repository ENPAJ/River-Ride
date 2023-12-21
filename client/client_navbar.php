<?php
session_start();
require_once '../db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

$sqlPointArret = "SELECT * FROM pointarret";
$sqlHebergement = "SELECT * FROM hebergement";

$stmtPointArret = $conn->query($sqlPointArret);
$stmtHebergement = $conn->query($sqlHebergement);

$points_arret = $stmtPointArret->fetchAll(PDO::FETCH_ASSOC);
$hebergement = $stmtHebergement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['search'])) {
    $selectedPointArretId = $_GET['selected_point_arret']; // Make sure to sanitize this input

    // Fetch the associated hebergement_id from the pointarret table
    $sqlPointArret = "SELECT hebergement_id FROM hebergement WHERE point_arret_id = :point_arret_id";
    $stmtPointArret = $conn->prepare($sqlPointArret);
    $stmtPointArret->bindParam(':point_arret_id', $selectedPointArretId);
    $stmtPointArret->execute();
    $hebergementIdResult = $stmtPointArret->fetch(PDO::FETCH_ASSOC);

    if ($hebergementIdResult) {
        $hebergementId = $hebergementIdResult['hebergement_id'];

        // Fetch the logements associated with the selected hebergement
        $sqlLogements = "SELECT * FROM logement WHERE hebergement_id = :hebergement_id";
        $stmtLogements = $conn->prepare($sqlLogements);
        $stmtLogements->bindParam(':hebergement_id', $hebergementId);
        $stmtLogements->execute();
        $logements = $stmtLogements->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Handle error if point d'arret doesn't have an associated hebergement
    }
}

?>

<!-- Rest of your HTML code -->
<!-- Rest of your HTML code -->
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <h1 class="m-0 text-primary"><?php echo $title ?></h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="../index.php" class="nav-item nav-link active">Accueil</a>
                        <a href="#options" class="nav-item nav-link">Options</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Historique</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="property-list.html" class="dropdown-item">Property List</a>
                                <a href="property-type.html" class="dropdown-item">Property Type</a>
                                <a class="dropdown-item" onclick="history.back()">Retour</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Compte</a>
                    </div>
                    <a href="../logout.php" class="btn btn-primary px-3 d-none d-lg-flex">Deconnexion</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid" src="../img/couple_together.png" alt="">
                </div>
                
            </div>
        </div>
        <!-- Header End -->

        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                <form action="reservation/search_results.php" method="GET" class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Mots cles">
                            </div>
                            <div class="col-md-4">
                            <select class="form-select border-0 py-3" name="selected_hebergement">
                                    <option selected>Hebergement</option>
                                    <?php foreach ($hebergement as $hebergement_item) : ?>
                                        <option value="<?php echo $hebergement_item['hebergement_id']; ?>">
                                            <?php echo htmlspecialchars($hebergement_item['nom']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0 py-3" name="selected_point_arret">
                                    <option selected>Point d'arret</option>
                                    <?php foreach ($points_arret as $point_arret) : ?>
                                        <option value="<?php echo $point_arret['point_arret_id']; ?>">
                                            <?php echo htmlspecialchars($point_arret['nom']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark border-0 w-100 py-3" name="search">Recherche</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
        <!-- Search End -->
