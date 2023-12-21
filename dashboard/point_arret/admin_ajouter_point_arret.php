<?php
include '../dashboard_head.php';
require_once '../db.php';

$message = ""; // Initialize the information message
$alertClass = ""; // Initialize the alert class

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom'], $_POST['description'], $_POST['latitude'], $_POST['longitude'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $latitude = floatval($_POST['latitude']);
        $longitude = floatval($_POST['longitude']);
    
        // Create a folder to store images if it doesn't exist
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = $_FILES['photo']['tmp_name'];
            $image_name = $_FILES['photo']['name'];
            $image_path = $uploadDir . $image_name;
        
            // Move the uploaded image to the server's file system
            move_uploaded_file($image_tmp, $image_path);

            try {
                // Code to insert the point of stop into the database
                $sql = "INSERT INTO pointarret (nom, description, latitude, longitude, photo) VALUES (:nom, :description, :latitude, :longitude, :photo)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
                $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
                $stmt->bindParam(':photo', $image_path); // Store the image path
                $stmt->execute();

                header("Location: admin_afficher_point_arrets.php");
                exit();

            } catch (PDOException $e) {
                // Handle PDO errors
                $message = "An error occurred while creating the pointarret: " . $e->getMessage();
                $alertClass = "alert alert-danger"; // Failure alert class
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Creer Point d'Arrêt</title>
</head>
<body class="g-sidenav-show bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    <main class="main-content position-relative border-radius-lg ">
        <?php include '../dashboard_mainnav.php'; ?>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div>
                                    <h3 style="color: black;">Créer point d'arret</h3>
                                    <button type="button" class="btn btn-warning" style="background:orange; color:black;">
                                        <a href="admin_afficher_point_arrets.php">Liste des points d'arret</a>
                                    </button>
                                </div>

                                <div id="alertMessage" class="<?php echo $alertClass; ?>"><?php echo $message; ?></div>
                                <form id="pointarretForm" method="POST" action="" enctype="multipart/form-data" style="padding: 20px;">
                                    <div class="form-group">
                                        <input type="text" placeholder="Nom" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea placeholder="Description" name="description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="float" class="form-control" placeholder="Latitude" id="latitude" name="latitude">
                                    </div>
                                    <div class="form-group">
                                        <input type="float" class="form-control" placeholder="Longitude" id="longitude" name="longitude">
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photos</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                    <div style="align-self: center; margin:10px;">
                                        <button type="submit" class="btn btn-success btn-lg">Créer</button>
                                        <button type="button" class="btn btn-secondary btn-lg" onclick="annuler()">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Rest of your HTML code ... -->
</body>
</html>
