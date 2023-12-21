<?php
session_start();
// Inclure le fichier db.php pour la connexion à la base de données
require_once 'db.php';
// signup.php -->

// Variables pour stocker les valeurs du formulaire
$nom = $prenom = $email = $mot_de_passe = $confirmation_mot_de_passe = "";
$nom_err = $prenom_err = $email_err = $mot_de_passe_err = $confirmation_mot_de_passe_err = "";

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Valider le nom
        if (empty($_POST["nom"])) {
            $nom_err = "Veuillez saisir votre nom.";
        } else {
            $nom = trim($_POST["nom"]);
        }

        // Valider le prénom
        if (empty($_POST["prenom"])) {
            $prenom_err = "Veuillez saisir votre prénom.";
        } else {
            $prenom = trim($_POST["prenom"]);
        }
    }

    // Vérifier l'email
    if (empty($_POST["email"])) {
        $email_err = "Veuillez saisir votre adresse email.";
    } else {
        // Vérifier si l'email existe déjà dans la base de données
        $sql = "SELECT client_id FROM Clients WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(1, $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    $email_err = "Cet email est déjà utilisé.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
            }
        }
    }



    // Valider le mot de passe
    if (empty($_POST["mot_de_passe"])) {
        $mot_de_passe_err = "Veuillez saisir votre mot de passe.";
    } elseif (strlen(trim($_POST["mot_de_passe"])) < 8) {
        $mot_de_passe_err = "Votre mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match("/[A-Z]/", $_POST["mot_de_passe"])) {
        $mot_de_passe_err = "Votre mot de passe doit contenir au moins une majuscule.";
    } elseif (!preg_match("/[!@#$%^&*()_+<>?]+/", $_POST["mot_de_passe"])) {
        $mot_de_passe_err = "Votre mot de passe doit contenir au moins un caractère spécial.";
    } else {
        $mot_de_passe = trim($_POST["mot_de_passe"]);
    }

    // Valider la confirmation du mot de passe
    if (empty($_POST["confirmation_mot_de_passe"])) {
        $confirmation_mot_de_passe_err = "Veuillez confirmer votre mot de passe.";
    } else {
        $confirmation_mot_de_passe = trim($_POST["confirmation_mot_de_passe"]);
        if (empty($mot_de_passe_err) && ($mot_de_passe != $confirmation_mot_de_passe)) {
            $confirmation_mot_de_passe_err = "Les mots de passe ne correspondent pas.";
        }
    }

    // Vérifier s'il n'y a pas d'erreurs avant d'insérer les données dans la base de données
    if (empty($nom_err) && empty($prenom_err) && empty($email_err) && empty($mot_de_passe_err) && empty($confirmation_mot_de_passe_err)) {
        // Préparer l'instruction SQL pour insérer les données dans la base de données
        $sql = "INSERT INTO Clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(':nom', $param_nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $param_prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            $stmt->bindParam(':mot_de_passe', $param_mot_de_passe, PDO::PARAM_STR);

            // Définir les paramètres
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_email = $email;
            $param_mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT); // Hachage du mot de passe

            if ($stmt->execute()) {
                // Récupérer l'ID du nouvel utilisateur inséré
                $newUserId = $conn->lastInsertId();

                $recupUser = $conn->prepare('SELECT * FROM clients WHERE client_id = ?');
                $recupUser->execute(array($newUserId));
                $userRow = $recupUser->fetch();

                $_SESSION['prenom'] = $prenom;
                $_SESSION['nom'] = $nom;
                $_SESSION['email'] = $email;
                $_SESSION['mot_de_passe'] = $mot_de_passe;
                $_SESSION['client_id'] = $userRow['client_id'];

                // Rediriger vers la page de connexion après l'inscription réussie
                header("location: login.php");
            } else {
                echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
            }
            $stmt->closeCursor(); // Ferme le curseur de l'objet PDOStatement
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Inscription</title>
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
                                    <i class="text-primary">RIVER RIDE</i>
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
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
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
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>