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

// Traitement de la soumission du formulaire de modification de la description
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_description'])) {
    $new_description = mysqli_real_escape_string($connexion, $_POST['description']);
    $sql_update_description = "UPDATE of SET description = ? WHERE id = ?";
    $stmt_update_description = mysqli_prepare($connexion, $sql_update_description);
    mysqli_stmt_bind_param($stmt_update_description, "si", $new_description, $id_of);
    if (mysqli_stmt_execute($stmt_update_description)) {
        echo "Description mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de la description : " . mysqli_error($connexion);
    }
    mysqli_stmt_close($stmt_update_description);
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
call_header();

// Traitement de la suppression d'une opération
if (isset($_GET['delete_operation'])) {
    $id_operation = intval($_GET['delete_operation']);
    if ($id_operation > 0) {
        $sql_delete = "DELETE FROM operation WHERE id = ?";
        $stmt_delete = mysqli_prepare($connexion, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $id_operation);
        if (mysqli_stmt_execute($stmt_delete)) {
            echo "Opération supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'opération : " . mysqli_error($connexion);
        }
        mysqli_stmt_close($stmt_delete);
    } else {
        echo "ID d'opération invalide.";
    }
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
                <form method="post" action="">
                    <p class="description">
                        <span class="description1">Description</span> :
                        <input type="text" name="description" value="<?php echo htmlspecialchars($of['description']); ?>">
                        <button type="submit" name="update_description">Mettre à jour</button>
                    </p>
                </form>
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
                        <th>Action</th>
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
                        echo "<td><a href='?id_of=" . $id_of . "&delete_operation=" . $row['id'] . "'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
                    echo "<button><a href='add_operation.php?id_of=". $id_of ."'>Ajouter des opérations</a></button>"
                ?>
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
