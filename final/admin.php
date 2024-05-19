<?php
// Inclure les fichiers nécessaires
include_once __DIR__ . '/includes.php';
session_start();
call_header();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    header("Location: index.php");
    exit();
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

// Supprimer un OF s'il y a une demande
if (isset($_GET['id'])) {
    $id_of = intval($_GET['id']);
    
    if ($id_of > 0) {
        $sql_supprimer = "DELETE FROM of WHERE id = $id_of";
        
        if (mysqli_query($connexion, $sql_supprimer)) {
            echo "OF supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'OF : " . mysqli_error($connexion);
        }
    } else {
        echo "ID de l'OF invalide.";
    }
} else {
    echo "ID de l'OF non spécifié.";
}
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
                <th colspan="4">Action</th>
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
            $id_of = $row['id'];
            $sql_agent = "SELECT * FROM agent WHERE id = $id_agent";
            $result_agent = mysqli_query($connexion, $sql_agent);

            // Vérifier si la requête a réussi
            if ($result_agent) {
                $agent = mysqli_fetch_assoc($result_agent);
                echo "<td>" . htmlspecialchars($agent['nom'] . " " . htmlspecialchars($agent['prenom'])) . "</td>";
            } else {
                echo "<td>Erreur de récupération de l'agent</td>";
            }

            echo "<td><a href='consulter_of.php?id=" . $id_of . "'>Consulter</a></td>";
            echo "<td><a href='modifier_of.php?id=" . $id_of . "'>Modifier</a></td>";
            echo "<td><a href='?id=" . $id_of . "'>Supprimer</a></td>";
            echo "<td><a href='?calcul=" . $id_of . "'>Lancer calcul du coût</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <footer>
        <button class="button"><a href="add_user.php">Ajouter un agent</a></button>
        <button class="button"><a href="of.php">Ajouter un OF</a></button>
    </footer>
</body>
</html>

<?php
// Fermer la connexion
mysqli_close($connexion);
?>
