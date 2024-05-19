<?php
// Inclure les fichiers nécessaires
include_once __DIR__ . '/includes.php';
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

$id_of = intval($_GET['id_of']);

// Traitement du formulaire d'ajout d'opération
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_operation'])) {
    $operation_description = mysqli_real_escape_string($connexion, $_POST['operation_description']);
    $id_matiere = intval($_POST['id_matiere']);
    $cout = floatval($_POST['cout']);
    $quantite = intval($_POST['quantite']);
    $temps = floatval($_POST['temps']);

    $sql_operation = "INSERT INTO operation (description, id_of, id_matiere, cout, quantite, temps) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_operation = mysqli_prepare($connexion, $sql_operation);
    mysqli_stmt_bind_param($stmt_operation, "siiidi", $operation_description, $id_of, $id_matiere, $cout, $quantite, $temps);

    if (mysqli_stmt_execute($stmt_operation)) {
        echo "Opération ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'opération : " . mysqli_error($connexion);
    }

    mysqli_stmt_close($stmt_operation);
}

// Fermer la connexion
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des Opérations et des Matériaux</title>
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <h2>Ajouter des Opérations et des Matériaux pour l'OF #<?php echo $id_of; ?></h2>
    <form action="add_operation.php?id_of=<?php echo $id_of; ?>" method="post">
        <h3>Ajouter une Opération</h3>
        <div class="form-group">
            <label for="operation_description">Description de l'opération :</label>
            <textarea name="operation_description" id="operation_description" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="id_matiere">Matériau :</label>
            <select name="id_matiere" id="id_matiere">
                <?php
                $sql_matiere = "SELECT id, materiaux FROM matiere";
                $result_matiere = mysqli_query($connexion, $sql_matiere);
                while ($row = mysqli_fetch_assoc($result_matiere)) {
                    echo '<option value="' . $row['id'] . '">' . $row['materiaux'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cout">Coût :</label>
            <input type="number" name="cout" id="cout" step="0.01">
        </div>
        <div class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite">
        </div>
        <div class="form-group">
            <label for="temps">Temps :</label>
            <input type="number" name="temps" id="temps" step="0.1">
        </div>
        <button type="submit" name="add_operation">Ajouter Opération</button>
    </form>
    <button><a href="admin.php">Retour</a></button>
</body>
</html>
