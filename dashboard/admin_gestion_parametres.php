<!-- admin_gestion_parametres.php -->
<?php
// Code pour vérifier l'authentification de l'admin ici...
// ...

// Inclure le fichier db.php pour la connexion à la base de données
include('db.php');

// Récupérer la valeur actuelle de la première promotion depuis la table Parametres
$sql = "SELECT valeur_parametre FROM Parametres WHERE nom_parametre = 'promo_initiale'";
$result = $conn->query($sql);
$row = $result->fetch(); // Utilisation de fetch() au lieu de fetch_assoc()
$valeurPromoInitiale = $row['valeur_parametre'];

// Traitement du formulaire de modification de la valeur de la première promotion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la nouvelle valeur de la première promotion depuis le formulaire
    $nouvelleValeur = floatval($_POST["nouvelle_valeur"]);

    // Valider les données (vous pouvez ajouter d'autres validations ici)
    if ($nouvelleValeur <= 0) {
        $error_message = "La valeur de la première promotion doit être supérieure à zéro.";
    } else {
        // Mettre à jour la valeur de la première promotion dans la table Parametres
        $sql_update = "UPDATE Parametres SET valeur_parametre = ? WHERE nom_parametre = 'promo_initiale'";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(1, $nouvelleValeur, PDO::PARAM_STR); // Utilisation de bindParam pour définir le type
        $stmt_update->execute();

        if ($stmt_update->rowCount() > 0) {
            // Rediriger vers la page d'affichage des paramètres après la mise à jour
            header("Location: admin_gestion_parametres.php");
            exit();
        } else {
            $error_message = "Une erreur est survenue lors de la mise à jour de la valeur de la première promotion. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Paramètres - Admin</title>
</head>
<body>
    <h2>Modifier la valeur de la première promotion</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nouvelle_valeur">Nouvelle valeur :</label>
        <input type="number" step="0.01" name="nouvelle_valeur" value="<?php echo $valeurPromoInitiale; ?>" required>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
