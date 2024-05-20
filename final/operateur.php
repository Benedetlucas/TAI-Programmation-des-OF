<?php
$host = "localhost";
$dbname = "tai";
$user = "root";
$pwd = "";

// Crée une connexion à la base de données
$connexion = mysqli_connect($host, $user, $pwd, $dbname);

// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Démarre la session
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: index.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Appel à la fonction call_header() pour inclure l'en-tête de la page
call_header_agent();
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
            <th>Description</th>
            <th>Consulter</th>
            <th>Remplir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Requête SQL pour obtenir la liste des OF pour l'utilisateur connecté
        $identifiant = $_SESSION['identifiant'];
        $sql_agent = "SELECT id FROM agent WHERE identifiant = '$identifiant'";
        $result_agent = mysqli_query($connexion, $sql_agent);

        if ($result_agent && mysqli_num_rows($result_agent) > 0) {
            $agent = mysqli_fetch_assoc($result_agent);
            $id_agent = $agent['id'];

            $sql_of = "SELECT * FROM of WHERE id_agent = $id_agent AND etat = 0";
            $result_of = mysqli_query($connexion, $sql_of);

            // Afficher les OF dans le tableau
            if ($result_of && mysqli_num_rows($result_of) > 0) {
                while ($row = mysqli_fetch_assoc($result_of)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td><a href='consulter_of.php?id_of=" . $row['id'] . "'>Consulter</a></td>";
                    echo "<td><a href='of_operateur.php?id_of=" . $row['id'] . "'>Remplir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun OF trouvé avec un état égal à 1 pour cet utilisateur.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun OF trouvé pour cet utilisateur.</td></tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
