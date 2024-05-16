<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: login.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Affiche le contenu de la page d'accueil
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'inclure votre fichier CSS -->
</head>
<body>
    <h1>Bienvenue sur la page d'accueil</h1>
    <p>Bonjour, <?php echo $_SESSION['identifiant']; ?> ! Vous êtes connecté.</p>
    <a href="login.php">Déconnexion</a> <!-- Lien pour se déconnecter -->
</body>
</html>
