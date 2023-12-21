<?php// Code de réservation (par exemple, dans reservation.php)
session_start()
if (isset($_POST["code_promo"]) && !empty($_POST["code_promo"])) {
    $codePromo = $_POST["code_promo"];
    
    // Vérifier si le code promo est valide et n'a pas expiré
    $sql = "SELECT * FROM CodePromo WHERE code_promo = ? AND date_creation + INTERVAL duree DAY > NOW() LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codePromo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Le code promo est valide, appliquer la réduction au montant total de la réservation
        $row = $result->fetch_assoc();
        $reduction = 0.1; // 10% de réduction (exemple)

        $montantTotal = /* calculer le montant total de la réservation */;
        $montantTotalAvecReduction = $montantTotal - ($montantTotal * $reduction);
    } else {
        // Le code promo est invalide ou a expiré, afficher un message d'erreur
        $error_message = "Le code promo est invalide ou a expiré.";
    }

    // Code pour calculer le montant total de la réservation
        $prixUnitaireChambre = 100; // Prix unitaire d'une chambre
        $prixUnitaireService = 20; // Prix unitaire d'un service supplémentaire

        $quantiteChambres = $_POST["quantite_chambres"];
        $quantiteServices = $_POST["quantite_services"];

    // Vérifier si le client a déjà utilisé la promotion
    $userId = $_SESSION['user_id']; /* Récupérer l'ID de l'utilisateur en cours */;
    $sql_check_promo = "SELECT promo_utilisee FROM Utilisateur WHERE utilisateur_id = ?";
    $stmt_check_promo = $conn->prepare($sql_check_promo);
    $stmt_check_promo->bind_param("i", $userId);
    $stmt_check_promo->execute();
    $result_check_promo = $stmt_check_promo->get_result();

    if ($result_check_promo->num_rows == 1) {
        $row = $result_check_promo->fetch_assoc();
        $promoUtilisee = $row['promo_utilisee'];

        if (!$promoUtilisee) {
            // Le client n'a pas encore utilisé la promotion, appliquer la réduction au montant total de la réservation
            $reduction = 0.1; // 10% de réduction (exemple)

            /* calculer le montant total de la réservation */
            $montantTotal = ($prixUnitaireChambre * $quantiteChambres) + ($prixUnitaireService * $quantiteServices); /* calculer le montant total de la réservation */;
            $montantTotalAvecReduction = $montantTotal - ($montantTotal * $reduction);

            // Mettre à jour la colonne promo_utilisee pour indiquer que le client a utilisé la promotion
            $sql_update_promo = "UPDATE Utilisateur SET promo_utilisee = 1 WHERE utilisateur_id = ?";
            $stmt_update_promo = $conn->prepare($sql_update_promo);
            $stmt_update_promo->bind_param("i", $userId);
            $stmt_update_promo->execute();
        }
    }
}
