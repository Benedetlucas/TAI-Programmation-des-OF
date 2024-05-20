<?php
// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Démarre la session
session_start();

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

// Appel de la fonction call_header()
call_header();

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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global_operateur.css" />
    <link rel="stylesheet" href="./index_operateur.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" />
    <style>
        /* Votre style CSS */
    </style>
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
            <table border="1">
                <tr>
                    <th>Description</th>
                    <th>Coût</th>    
                    <th>Nom du Matériau</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Temps</th>
                    <th>Coût Calculé</th>
                </tr>
                <?php
                    $total_cost = 0;

                    $sql_operations = "SELECT o.*, m.materiaux AS nom_matiere, m.prix AS prix_matiere 
                    FROM operation o 
                    INNER JOIN matiere m ON o.id_matiere = m.id 
                    WHERE o.id_of = $id_of";
                    $result_operations = mysqli_query($connexion, $sql_operations);

                    // Vérifie si la requête a réussi
                    if ($result_operations && mysqli_num_rows($result_operations) > 0) {
                        // Afficher les opérations dans le tableau
                        while ($row = mysqli_fetch_assoc($result_operations)) {
                            $calculated_cost = ($row['quantite'] * $row['prix_matiere']) + $row['cout'] + ($row['temps'] * 10.8);
                            $total_cost += $calculated_cost;
                            
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cout']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nom_matiere']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['prix_matiere']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['temps']) . "</td>"; // Ajout du temps
                            echo "<td>" . htmlspecialchars($calculated_cost) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucune opération trouvée pour cet OF.</td></tr>";
                    }
                ?>
                <tr>
                    <td colspan="7" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong><?php echo htmlspecialchars($total_cost . " €"); ?></strong></td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>

<?php
// Fermer la connexion
mysqli_close($connexion);
?>
