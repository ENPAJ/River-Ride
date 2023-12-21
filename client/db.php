<!-- db.php -->
<?php
$host = "riverru855.mysql.db";
$username = "riverru855";
$password = "8JEu5NxUGZuS";
$dbname = "riverru855";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
