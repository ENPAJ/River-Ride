<?php
// Inclure les fichiers nécessaires
require_once '../db.php';
$title = "Plage tarifaire";

?>

<?php
include '../client_head.php';
include '../client_navbar.php';
?>

    <style>
        .badge-rouge {
            background-color: red;
        }
        .badge-vert {
            background-color: green;
        }
    </style>

    <h2 style="display: flex; justify-content: center;">Calendrier des Plages Tarifaires</h2>
    <div class="center-div" style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <table border="1">
        <tr>
            <th>Jour</th>
            <th>Plage Tarifaire</th>
        </tr>
        <?php

        $sql = "SELECT * FROM Tarification";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $plagesTarifaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Supposons que $plagesTarifaires soit un tableau avec les données des plages tarifaires
            foreach ($plagesTarifaires as $plage) {
                $dateDebut = new DateTime($plage['date_debut']);
                $dateFin = new DateTime($plage['date_fin']);
                $tarif = $plage['tarif'];
                
                while ($dateDebut <= $dateFin) {
                    $badgeClass = '';
                    if ($tarif > 1.60) {
                        $badgeClass = 'badge-rouge';
                    } elseif ($tarif < 1.30) {
                        $badgeClass = 'badge-vert';
                    }
                    
                    echo '<tr>';
                    echo '<td>' . $dateDebut->format('d/m/Y') . '</td>';
                    echo '<td>';
                    echo '<span class="' . $badgeClass . '">' . $plage['nom'] . '</span><br>';
                    echo 'Description : ' . $plage['description'];
                    echo '</td>';
                    echo '</tr>';
                    
                    $dateDebut->modify('+1 day');
                }
            }
        ?>
    </table>
    </div>

    
<?php include '../client_footer.php'; ?>