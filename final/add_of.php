<?php
// Inclure le fichier de connexion à la base de données
include_once 'connexion_bd.php';

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
    } else {
        echo "Erreur : " . mysqli_error($connexion);
    }
}
?>
