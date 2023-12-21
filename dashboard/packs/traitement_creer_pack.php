<!-- traitement_creer_pack.php -->
<?php
  include '../dashboard_head.php';
  require_once '../db.php';

?>  

<?php
// Code pour vérifier l'authentification de l'admin ici...
// ...

// Code pour récupérer les données soumises depuis le formulaire
if (isset($_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['hebergements'], $_POST['services'], $_POST['itineraires'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $hebergements = $_POST['hebergements'];
    $itineraires = $_POST['itineraires'];

    // Code pour insérer les données du pack dans la base de données
    // Utilisez des requêtes SQL pour insérer les données dans la table Pack.
    // Assurez-vous de gérer les clés étrangères correctement en fonction de la structure de votre base de données.
    // ...

    // Après l'ajout du pack, redirigez vers une page de confirmation ou une autre page appropriée.
    // Par exemple :
    header("Location: admin_afficher_packs.php");
    exit();
} else {
    // Rediriger vers une page d'erreur si le formulaire n'a pas été soumis correctement
    // Par exemple :
    header("Location: erreur.php");
    exit();
}
?>
