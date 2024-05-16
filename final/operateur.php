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

// Affiche le contenu de la page d'accueil
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index_admin.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@600&display=swap" />
</head>
<body>
<table class="tableau">
    <h2>Operateur</h2>
    <p>Bonjour, <?php echo $_SESSION['identifiant']; ?></p>
    <thead>
        <tr>
            <th>N°OF</th>
            <th>Consulter</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>OF001</td>
            <td><a href="#">Consulter</a></td>
            <td><a href="#">Modifier</a></td>
        </tr>
        <tr>
            <td>OF002</td>
            <td><a href="#">Consulter</a></td>
            <td><a href="#">Modifier</a></td>
        </tr>
        <!-- Ajoutez d'autres lignes ici si nécessaire -->
    </tbody>
</table>

</body>
</html>

