<?php
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
    <h2>Administrateur</h2>
    <p>Bonjour, <?php echo $_SESSION['identifiant']; ?></p>
    <thead>
        <tr>
            <th>N°OF</th>
            <th>Opérateur</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Requête SQL pour obtenir la liste des OF
        $sql_of = "SELECT * FROM of";
        $result_of = mysqli_query($connexion, $sql_of);

        // Afficher les OF dans le tableau
        while ($row = mysqli_fetch_assoc($result_of)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
    
        // Requête SQL pour obtenir le nom de l'agent à partir de son id
        $id_agent = $row['id_agent'];
        $sql_agent = "SELECT * FROM agent WHERE id = $id_agent";
        $result_agent = mysqli_query($connexion, $sql_agent);
    
        // Vérifier si la requête a réussi
        if ($result_agent) {
            // Récupérer les données de l'agent
            $agent = mysqli_fetch_assoc($result_agent);
        
            // Afficher le nom de l'agent dans le tableau
            echo "<td>" . $agent['nom'] . " " . $agent['prenom'] . "</td>";
        } else {
            // Afficher un message d'erreur si la requête a échoué
            echo "<td>Erreur de récupération de l'agent</td>";
        }
    
        echo "<td><a href='consulter_of.php?id=" . $row['id'] . "'>Consulter</a></td>";
        echo "<td><a href='modifier_of.php?id=" . $row['id'] . "'>Modifier</a></td>";
        echo "<td><a href='supprimer_of.php?id=" . $row['id'] . "'>Supprimer</a></td>";
        echo "</tr>";
        }
    ?>

    </tbody>
</table>

<footer>
    <button class="button"><a href="add_user.php">Ajouter un agent</a></button>
    <button class="button" ><a href="of.php">Ajouter un OF</a></button>
    <button class="button">Lancer le calcul du coût d'un OF</button>
</footer>
</body>
</html>

