<?php
// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Appel à la fonction call_header() pour inclure l'en-tête de la page
call_header();
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: index.php");
    exit(); // Arrête l'exécution du script après la redirection
}

$host = "localhost";
$dbname = "tai";
$user = "root";
$pwd = "";

// Crée une connexion à la base de données
$connexion = mysqli_connect($host, $user, $pwd, $dbname);

// Vérifie si la connexion a échoué
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Affiche le contenu de la page d'accueil
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un OF</title>
    <link rel="stylesheet" href="global.css"> <!-- Assurez-vous d'inclure votre fichier CSS -->
</head>
<body>
    <h2>Ajouter un OF</h2>
    <form action="add_of.php" method="post">
        <div class="form-group">
            <label for="id_agent">Agent :</label>
            <select name="id_agent" id="id_agent">
                <!-- Liste des noms des agents -->
                <?php

                    // Requête SQL pour obtenir les noms des agents
                    $sql = "SELECT id, prenom, nom FROM agent";
                    $result = mysqli_query($connexion, $sql);

                    // Afficher les options pour chaque agent
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['prenom'] . ' ' . $row['nom'] . '</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="etat">Etat :</label>
            <select name="etat" id="etat">
                <option value="1">Fait</option>
                <option value="0">Pas fait</option>
            </select>
        </div>
        <button type="submit">Ajouter</button>
    </form>
    <button><a href="admin.php">Retour</a></button>
</body>
</html>
