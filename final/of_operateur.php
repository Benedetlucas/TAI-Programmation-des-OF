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
    exit();
}

// Récupère l'ID de l'OF depuis l'URL
$id_of = isset($_GET['id_of']) ? intval($_GET['id_of']) : 0;

// Vérifie si l'ID de l'OF est valide
if ($id_of <= 0) {
    echo "OF invalide.";
    exit();
}

// Requête SQL pour obtenir les détails de l'OF
$sql_of = "SELECT of.*, agent.nom, agent.prenom 
           FROM of 
           LEFT JOIN agent ON of.id_agent = agent.id 
           WHERE of.id = $id_of";
$result_of = mysqli_query($connexion, $sql_of);

// Vérifie si la requête a réussi et s'il y a des résultats
if ($result_of && mysqli_num_rows($result_of) > 0) {
    $of = mysqli_fetch_assoc($result_of);
} else {
    echo "OF non trouvé.";
    exit();
}

// Appel à la fonction call_header() pour inclure l'en-tête de la page
call_header_agent();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global_operateur.css" />
    <link rel="stylesheet" href="./index_operateur.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" />
</head>
<body>
    <div class="search">
        <img class="search-icon" alt="" src="./public/search.svg" />
        <div class="label">Search...</div>
    </div>
    <main class="bar-chart-wrapper">
        <section class="bar-chart">
            <div class="of-2-parent">
                <div class="of-2">OF <?php echo htmlspecialchars($of['id']); ?></div>
                <div class="assign-danae-mark-wrapper">
                    <div class="assign">Assigné à : <?php echo htmlspecialchars($of['prenom']) . ' ' . htmlspecialchars($of['nom']); ?></div>
                </div>
            </div>
            <div class="description-container">
                <p class="description">
                    <span class="description1">Description</span> :
                    <span><?php echo htmlspecialchars($of['description']); ?></span>
                </p>
            </div>
            <h3>Liste des Opérations pour l'OF #<?php echo $id_of; ?></h3>
            <form action="save_operations.php" method="post">
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>ID OF</th>
                        <th>Nom du Matériau</th>
                        <th>Coût</th>
                        <th>Quantité</th>
                        <th>Temps</th>
                    </tr>
                    <?php
                    // Requête SQL pour obtenir les opérations associées à cet OF avec les détails du matériau
                    $sql_operations = "SELECT o.*, m.materiaux AS nom_matiere 
                                       FROM operation o 
                                       INNER JOIN matiere m ON o.id_matiere = m.id 
                                       WHERE o.id_of = $id_of";
                    $result_operations = mysqli_query($connexion, $sql_operations);

                    // Afficher les opérations dans le tableau avec la possibilité de les modifier
                    while ($row = mysqli_fetch_assoc($result_operations)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['id_of'] . "</td>";
                        echo "<td>" . $row['nom_matiere'] . "</td>";
                        echo "<td>" . $row['cout'] . "</td>";
                        echo "<td><input type='number' name='quantite[]' value='" . $row['quantite'] . "'></td>";
                        echo "<td><input type='number' name='temps[]' value='" . $row['temps'] . "'></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <button type="submit">Enregistrer les modifications</button>
            </form>
        </section>
    </main>
</body>
</html>
