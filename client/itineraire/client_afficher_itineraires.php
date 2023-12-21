<?php
$title = "Afficher Itinéraire";
include '../client_head.php';
include '../client_navbar.php';

if (isset($_POST['points_selectionnes']) && is_array($_POST['points_selectionnes'])) {
    // Retrieve the itinerary details
    $points_selectionnes = $_POST['points_selectionnes'];
    $client_id = 1; // You might want to retrieve the client ID from session or elsewhere

    // Display the itinerary details
    echo '<h2 style="display: flex; justify-content: center;">Itinéraire Créé</h2>';
    echo '<div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">';
    echo '<ul>';
    foreach ($points_selectionnes as $point_id) {
        $nom_point = ''; // Retrieve the point name using SQL query

        echo '<li>';
        echo 'Point d\'arrêt: ' . htmlspecialchars($nom_point) . '<br>';
        echo 'Ordre: ' . $_POST['ordre'][$point_id] . '<br>';
        echo 'Date de début: ' . $_POST['date_debut'][$point_id] . '<br>';
        echo 'Date de fin: ' . $_POST['date_fin'][$point_id] . '<br>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="alert alert-success" role="warning">
            <h4 class="alert-heading">Itinéraire non trouvé</h4>
            <p>Aucun itinéraire n\'a été trouvé.</p>
        </div>';
}

include '../client_footer.php';
?>
