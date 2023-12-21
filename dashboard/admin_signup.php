<!-- admin_signup.php -->
<?php
// Ajoutez la logique d'inscription de l'administrateur ici
// Initialisez les variables d'erreur
$prenom = "";
$nom = "";
$email = "";
$mot_de_passe = "";
$prenom_err = "";
$nom_err = "";
$email_err = "";
$mot_de_passe_err = "";
$confirmation_mot_de_passe_err = "";
// Exemple de code pour l'insertion dans la base de données
 require_once 'db.php';
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Récupérer les valeurs du formulaire
     $nom = $_POST["nom"];
     $prenom = $_POST["prenom"];
     $email = $_POST["email"];
     $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    // Insérer les informations d'inscription dans la base de données
    $sql = "INSERT INTO Admin (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);

    try {
        $stmt->execute();
        // Rediriger vers la page de connexion après l'inscription réussie
        header("Location: admin_login.php");
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        echo "Erreur PDO : " . $e->getMessage();
    }
 }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Admin Signup</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div >
                                <a href="index.html" class="">
                                    <i class="text-primary">Admin RIVER RIDE</i>
                                </a>
                                <h3>Inscription</h3>
                            </div>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
                            <label for="nom">Nom</label>
                            <span><?php echo $nom_err; ?></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $nom; ?>">
                            <label for="prenom">Prenom</label>
                            <span><?php echo $prenom_err; ?></span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                            <label for="email">Email</label>
                            <span><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
                            <label for="mot_de_passe">Mot de passe</label>
                            <span><?php echo $mot_de_passe_err; ?></span>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe">
                            <label for="confirmation_mot_de_passe">Mot de passe de confirmation</label>
                            <span><?php echo $confirmation_mot_de_passe_err; ?></span>
                        </div>
                        <div class="col d-flex align-items-center justify-content-between mb-4">
                            <a href="">Mot de passe oublie ?</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">S'inscrire</button>
                        <p class="text-center mb-0">Vous avez deja un compte? <a href="login.php">Connexion</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>