<?php
session_start();
include 'db.php';

if (isset($_SESSION['email'])) {
    $prenom = $_SESSION['prenom'];
} else {
    $prenom = "Utilisateur"; // ou un autre texte par défaut
}
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>River Ride</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
                    <h1 class="m-0 text-primary">River Ride</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-item nav-link active">Accueil</a>
                        <a href="#options" class="nav-item nav-link">Options</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Historique</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="property-list.html" class="dropdown-item">Property List</a>
                                <a href="property-type.html" class="dropdown-item">Property Type</a>
                                <a class="dropdown-item" onclick="history.back()" class="dropdown-item">Retour</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Compte</a>
                    </div>
                    <a href="logout.php" class="btn btn-primary px-3 d-none d-lg-flex">Deconnexion</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Bonjour<span class="text-primary"></span></h1>
                    <p class="animated fadeIn mb-4 pb-2">Profitez de River Ride pour<br> organiser votre excursion le long de la loire.</p>
                    <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Go !</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="../img/canoechateau3pers.png" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="../img/canoe-rouge.png" alt="">
                        </div>
                    </div>
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


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="options">
                <div class="container">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                        <h1 class="mb-3">Options</h1>
                        <p>Vous avez hate de decouvrir la loire,
                            creez votre propre itineraire et reservez vos
                            hebergements sur RIVER RIDE</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="hebergement/client_afficher_hebergement.php"">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-apartment.png" alt="Icon">
                                    </div>
                                    <h6>Hebergement</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="services/client_afficher_services.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-villa.png" alt="Icon">
                                    </div>
                                    <h6>Services</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="packs/client_afficher_details_pack.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-house.png" alt="Icon">
                                    </div>
                                    <h6>Packs</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="itineraire/client_afficher_points_arret.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-housing.png" alt="Icon">
                                    </div>
                                    <h6>Itineraire</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-building.png" alt="Icon">
                                    </div>
                                    <h6>Reservations</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="plages/client_afficher_plage.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-neighborhood.png" alt="Icon">
                                    </div>
                                    <h6>Tarifs</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="promo/client_afficher_promo.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-neighborhood.png" alt="Icon">
                                    </div>
                                    <h6>Promo</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                            <a class="cat-item d-block bg-light text-center rounded p-3" href="client_profil.php">
                                <div class="rounded p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="img/icon-neighborhood.png" alt="Icon">
                                    </div>
                                    <h6>Dessin</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="../img/lac-cratere.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->    

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">River Ride</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="index.html">Pauline</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Accueil</a>
                                <a href="">Cookies</a>
                                <a href="">Aide</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>