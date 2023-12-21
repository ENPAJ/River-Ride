<?php
    $title= "Codes promo";
    require_once '../db.php';
?> 

<?php
// Récupérer la liste de tous les codes promo
$sql = "SELECT * FROM CodePromo";
$stmt = $conn->query($sql);
$codepromo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = $conn->query($sql);

?>

    <style>
        .table img {
            max-width: 100px;
            max-height: 100px;
        }
        .table td {
            text-align: center;
        }
    </style>
<?php
include '../client_head.php';
include '../client_navbar.php';
?>

<div class="g-sidenav-showbg- gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>    
        <div class="main-content position-relative border-radius-lg ">
            <!--  start dashboard_main.php   -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr style="text-align: center; color:black; text-decoration:solid;">
                                            <th scope="col">ID</th>
                                            <th scope="col">Code Promo</th>
                                            <th scope="col">Durée (jours)</th>
                                            <th scope="col">Date de Création</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $numero = 1; // Initialisez la variable du numéro
                                                foreach ($codepromo as $codepromos) :
                                            ?>
                                            <tr class="align-middle">
                                                <td><?php echo $numero++; ?></td>
                                                <td><?php echo $codepromos['code_promo']; ?></td>
                                                <td><?php echo $codepromos['duree']; ?></td>
                                                <td><?php echo $codepromos['date_creation']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include '../client_footer.php';
?>
