<!-- admin_profile.php -->
<?php
// Ajoutez la logique de gestion du profil de l'administrateur ici

    // Exemple de code pour afficher les informations du profil
    require_once 'db.php';
    session_start();
    if (!isset($_SESSION["admin_id"])) {
        header("location: admin_login.php");
        exit;
    }
        $admin_id = $_SESSION["admin_id"];
        $sql = "SELECT nom, prenom, email FROM Admin WHERE admin_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $nom = $row["nom"];
        $prenom = $row["prenom"];
        $email = $row["email"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Administrateur</title>
</head>
<body>
    <h2>Profil Administrateur</h2>
    <!-- Affichez les informations du profil de l'administrateur -->
    <!-- Vous pouvez ajouter des fonctionnalités pour modifier les informations du profil -->
</body>
</html>
