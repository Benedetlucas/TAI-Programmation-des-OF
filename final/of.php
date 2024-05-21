<?php
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

// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Démarre la session
session_start();
call_header();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: index.php");
    exit();
}

// Fonction pour ajouter un OF
function add_of($connexion) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_of'])) {
        $id_agent = intval($_POST['id_agent']);
        $description = mysqli_real_escape_string($connexion, $_POST['description']);
        $etat = intval($_POST['etat']);

        // Requête SQL pour insérer un nouvel OF
        $sql = "INSERT INTO of (id_agent, description, etat) VALUES ($id_agent, '$description', $etat)";

        // Exécute la requête
        if (mysqli_query($connexion, $sql)) {
            $id_of = mysqli_insert_id($connexion); // Récupère l'ID du nouvel OF inséré
            // Redirige vers add_operation.php avec l'ID de l'OF nouvellement créé
            header("Location: add_operation.php?id_of=$id_of");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'OF : " . mysqli_error($connexion);
        }
    }
}

// Appeler les fonctions en fonction du formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_of'])) {
        add_of($connexion);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un OF</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <h2>Ajouter un OF</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="id_agent">Agent :</label>
            <select name="id_agent" id="id_agent">
                <!-- Liste des noms des agents -->
                <?php
                // Requête SQL pour obtenir les noms des agents
                $sql = "SELECT id, prenom, nom FROM agent";
                $result = mysqli_query($connexion, $sql);

                // Afficher les options pour chaque agent
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['prenom'] . ' ' . $row['nom'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="4" cols="50"></textarea>
        </div>
        <div class="form-group">
            <label for="etat">Etat :</label>
            <select name="etat" id="etat">
                <option value="1">Fait</option>
                <option value="0">Pas fait</option>
            </select>
        </div>
        <button type="submit" name="add_of">Ajouter</button>
    </form>
    <button><a href="admin.php">Retour</a></button>
</body>
</html>

<?php
// Fermer la connexion
mysqli_close($connexion);
?>
