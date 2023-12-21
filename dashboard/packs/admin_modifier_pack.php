<?php
  include '../dashboard_head.php';
  require_once '../db.php';

  ?>  
<!-- admin_modifier_pack.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Pack</title>
</head>

<body>
    <h1>Modifier un Pack</h1>
    <form action="traitement_modifier_pack.php" method="post">
        <!-- Code pour récupérer les informations du pack à modifier depuis la base de données -->
        <!-- ...

        <label for="nom">Nom du Pack :</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($pack['nom']); ?>" required><br>

        <label for="description">Description :</label>
        <textarea name="description" rows="4" cols="50" required><?php echo htmlspecialchars($pack['description']); ?></textarea><br>

        <label for="prix">Prix :</label>
        <input type="number" step="0.01" name="prix" value="<?php echo $pack['prix']; ?>" required><br>

        <label for="hebergements">Hébergements inclus :</label>
        <select name="hebergements[]" multiple>
            <?php
            // Code pour récupérer la liste des hébergements depuis la base de données
            try {
                // Requête pour récupérer la liste des hébergements depuis la base de données
                $sql_hebergements = "SELECT id, nom FROM Hebergement";
                $stmt_hebergements = $conn->query($sql_hebergements);
                $hebergements = $stmt_hebergements->fetchAll(PDO::FETCH_ASSOC);
            
            // Afficher les options du select avec les hébergements disponibles
            foreach ($hebergements as $hebergement) {
                $selected = in_array($hebergement['id'], $hebergements_inclus) ? 'selected' : '';
                echo "<option value='" . $hebergement['id'] . "' $selected>" . htmlspecialchars($hebergement['nom']) . "</option>";
            }
        }
            ?>
        </select><br>

        <label for="services">Services inclus :</label>
        <select name="services[]" multiple>
            <?php
            // Code pour récupérer la liste des services depuis la base de données
            try {
                // Requête pour récupérer la liste des services depuis la base de données
                $sql_services = "SELECT id, nom FROM Services_complementaires";
                $stmt_services = $conn->query($sql_services);
                $services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);
            
            // Afficher les options du select avec les services disponibles
            foreach ($services as $service) {
                $selected = in_array($service['id'], $services_inclus) ? 'selected' : '';
                echo "<option value='" . $service['id'] . "' $selected>" . htmlspecialchars($service['nom']) . "</option>";
            }
        }
            ?>
        </select><br>

        <label for="itineraires">Itinéraires inclus :</label>
        <select name="itineraires[]" multiple>
            <?php
            // Code pour récupérer la liste des itinéraires depuis la base de données
            try {
                // Requête pour récupérer la liste des itineraires depuis la base de données
                $sql_itineraires = "SELECT id, nom FROM itineraires";
                $stmt_itineraires = $conn->query($sql_itineraires);
                $itineraires = $stmt_itineraires->fetchAll(PDO::FETCH_ASSOC);
            
            // Afficher les options du select avec les itinéraires disponibles
            foreach ($itineraires as $itinaire) {
                $selected = in_array($itinaire['id'], $itineraires_inclus) ? 'selected' : '';
                echo "<option value='" . $itinaire['id'] . "' $selected>" . htmlspecialchars($itinaire['nom']) . "</option>";
            }
        }
            ?>
        </select><br>

        <input type="hidden" name="pack_id" value="<?php echo $pack['id']; ?>">
        <input type="submit" value="Modifier le Pack">
    </form>
</body>

</html>
