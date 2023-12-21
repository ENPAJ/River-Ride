// verify_email.php


if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Rechercher le jeton dans la table VerificationToken
    $sql = "SELECT utilisateur_id, expire_at FROM VerificationToken WHERE token = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $utilisateur_id = $row['utilisateur_id'];
        $expire_at = strtotime($row['expire_at']);
        
        // Vérifier si le jeton n'a pas expiré
        if ($expire_at > time()) {
            // Mettre à jour le champ 'verifie' dans la table Utilisateur pour marquer le compte comme vérifié
            $sql_update = "UPDATE Utilisateur SET verifie = 1 WHERE utilisateur_id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $utilisateur_id);
            $stmt_update->execute();
            
            // Supprimer le jeton de vérification de la table VerificationToken
            $sql_delete = "DELETE FROM VerificationToken WHERE token = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("s", $token);
            $stmt_delete->execute();
            
            // Rediriger vers une page de confirmation de vérification
            header("location: verification_confirmed.php");
            exit;
        } else {
            $error_message = "Le lien de vérification a expiré. Veuillez demander un nouveau lien.";
        }
    } else {
        $error_message = "Le lien de vérification est invalide.";
    }
}
