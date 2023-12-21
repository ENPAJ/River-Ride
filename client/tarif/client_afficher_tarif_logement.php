<?php
include '../db.php';
// Supposons que vous ayez déjà récupéré les données du logement et les plages tarifaires correspondantes

// Récupérer la période sélectionnée lors de la réservation (par exemple, via un formulaire)
$periodeSelectionnee = $_POST['periode'];

// Trouver la plage tarifaire correspondante à la période sélectionnée
$tarif = 0; // initialiser le tarif par défaut

foreach ($plagesTarifaires as $plageTarifaire) {
    if ($periodeSelectionnee >= $plageTarifaire['date_debut'] && $periodeSelectionnee <= $plageTarifaire['date_fin']) {
        $tarif = $plageTarifaire['tarif'];
        break; // arrêter la boucle une fois qu'une plage tarifaire correspondante est trouvée
    }
}

// Calculer le prix en multipliant le tarif du logement par le tarif de la plage tarifaire correspondante
$prixLogement = $logement['prix']; // supposons que vous ayez récupéré le prix du logement depuis la base de données
$prixTotal = $prixLogement * $tarif;
?>

<!-- Afficher le prix total dans le formulaire de réservation -->
<form method="post">
    <!-- Autres champs de réservation ... -->
    <div>
        <label for="periode">Période :</label>
        <input type="date" name="periode" required>
    </div>
    <div>
        <label for="prix">Prix Total :</label>
        <input type="text" name="prix" value="<?php echo $prixTotal; ?>" readonly>
    </div>
    <div>
        <button type="submit">Réserver</button>
    </div>
</form>
