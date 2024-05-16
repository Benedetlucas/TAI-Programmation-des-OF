<?php
// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Appel à la fonction call_header() pour inclure l'en-tête de la page
call_header();
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
    <thead>
        <tr>
            <th>N°OF</th>
            <th>Opérateur</th>
            <th>Consulter</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>OF001</td>
            <td>John Doe</td>
            <td><a href="#">Consulter</a></td>
            <td><a href="#">Modifier</a></td>
            <td><a href="#">Supprimer</a></td>
        </tr>
        <tr>
            <td>OF002</td>
            <td>Jane Smith</td>
            <td><a href="#">Consulter</a></td>
            <td><a href="#">Modifier</a></td>
            <td><a href="#">Supprimer</a></td>
        </tr>
        <!-- Ajoutez d'autres lignes ici si nécessaire -->
    </tbody>
</table>

    <footer>
        <button>Ajouter un agent </button>
        <button>Ajouter un OF </button>
        <button>Lancer le calcul du coût d'un OF </button>
    </footer>
</body>
</html>

