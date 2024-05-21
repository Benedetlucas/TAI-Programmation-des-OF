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
$dbname = "tai_app_2023_2024_crab";
$user = "tai_app_2023_2024_crab";
$pwd = "JLAF75JO6X";

// Crée une connexion à la base de données
$connexion = mysqli_connect($host, $user, $pwd, $dbname);

// Vérifie si la connexion a échoué
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupère l'identifiant de l'utilisateur connecté
$identifiant = $_SESSION['identifiant'];

// Requête pour obtenir le type de l'utilisateur
$sql_agent = "SELECT type FROM agent WHERE identifiant = ?";
$stmt = mysqli_prepare($connexion, $sql_agent);
mysqli_stmt_bind_param($stmt, "s", $identifiant);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Vérifie si la requête a retourné un résultat
if ($result && mysqli_num_rows($result) > 0) {
    $agent = mysqli_fetch_assoc($result);
    $type = $agent['type'];

    // Appelle la fonction appropriée en fonction du type de l'utilisateur
    if ($type == 0) {
        call_header();
    } elseif ($type == 1) {
        call_header_agent();
    } else {
        // Gère les autres types ou les cas d'erreur
        echo "Type d'utilisateur inconnu.";
        exit();
    }
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

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

// Enregistrement des modifications des opérations
if (isset($_GET['save_operations']) && isset($_POST['quantite']) && isset($_POST['temps'])) {
    $quantites = $_POST['quantite'];
    $temps = $_POST['temps'];
    $operation_ids = $_POST['operation_id']; // Assurez-vous d'avoir un champ caché pour les IDs des opérations

    // Boucle à travers les opérations pour mettre à jour les quantités et les temps
    foreach ($operation_ids as $key => $id_operation) {
        $quantite = intval($quantites[$key]);
        $temps_value = floatval($temps[$key]);

        // Requête SQL pour mettre à jour la quantité et le temps de l'opération
        $sql_update_operation = "UPDATE operation SET quantite = ?, temps = ? WHERE id = ?";
        $stmt_update = mysqli_prepare($connexion, $sql_update_operation);
        mysqli_stmt_bind_param($stmt_update, "idi", $quantite, $temps_value, $id_operation);
        mysqli_stmt_execute($stmt_update);
    }

    // Mettre à jour l'état de l'OF pour qu'il passe à 1
    $sql_update_of = "UPDATE of SET etat = 1 WHERE id = ?";
    $stmt_update_of = mysqli_prepare($connexion, $sql_update_of);
    mysqli_stmt_bind_param($stmt_update_of, "i", $id_of);
    mysqli_stmt_execute($stmt_update_of);

    // Redirection vers la page operateur.php après enregistrement
    header("Location: operateur.php");
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
            <form action="?save_operations&id_of=<?php echo $id_of; ?>" method="post">
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
                        echo "<td><input type='hidden' name='operation_id[]' value='" . $row['id'] . "'>" . $row['id'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['id_of'] . "</td>";
                        echo "<td>" . $row['nom_matiere'] . "</td>";
                        echo "<td>" . $row['cout'] . "</td>";
                        echo "<td><input type='number' name='quantite[]' value='" . $row['quantite'] . "'></td>";
                        echo "<td><input type='number' step='0.01' name='temps[]' value='" . $row['temps'] . "'></td>";
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

<?php
// Fermer la connexion
mysqli_close($connexion);
?>
