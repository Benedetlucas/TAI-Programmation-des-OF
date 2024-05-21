<?php
// Inclure le fichier de connexion à la base de données
$host = "localhost";
$dbname = "tai_app_2023_2024_crab";
$user = "tai_app_2023_2024_crab";
$pwd = "JLAF75JO6X";

// Crée une connexion à la base de données
$connexion = mysqli_connect($host, $user, $pwd, $dbname);

// Vérifie si la connexion a échoué
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_agent = $_POST['id_agent'];
    $description = $_POST['description'];
    $etat = $_POST['etat'];

    // Préparer la requête SQL
    $sql = "INSERT INTO of (id_agent, description, etat) VALUES ('$id_agent', '$description', '$etat')";

    // Exécuter la requête
    if (mysqli_query($connexion, $sql)) {
        echo "OF ajouté avec succès.";
        echo "</br>";
        echo '<button><a href="of.php">Retour</a></button>';
    } 
    else {
        echo "Erreur : " . mysqli_error($connexion);
    }
}
?>
