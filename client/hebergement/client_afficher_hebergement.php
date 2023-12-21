<?php
    $title= "Hebergement";
    require_once '../db.php';
?> 

<?php
// Récupérer la liste de tous les codes promo
$sql = "SELECT * FROM hebergement";
$stmt = $conn->query($sql);
$hebergement = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                                                <th scope="col">#</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Capacité maximum</th>
                                                <th scope="col">  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $numero = 1; // Initialisez la variable du numéro
                                                foreach ($hebergement as $hebergementItem) :
                                            ?>
                                            <tr class="align-middle">
                                                <td><?php echo $numero++; ?></td>
                                                <td><?php echo htmlspecialchars($hebergementItem['nom']); ?></td>
                                                <td><?php echo htmlspecialchars($hebergementItem['description']); ?></td>
                                                <td><?php echo htmlspecialchars($hebergementItem['capacite_max']); ?></td>
                                                <td>                                                    
                                                    <button type="submit" class="btn btn-info btn-lg"><a href="client_details_hebergement.php?id=<?php echo $hebergementItem['hebergement_id']; ?>">Details</a></button>
                                                </td>
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
