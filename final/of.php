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
call_header();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: index.php");
    exit();
}


// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_agent = intval($_POST['id_agent']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $etat = intval($_POST['etat']);

    // Requête SQL pour insérer un nouvel OF
    $sql = "INSERT INTO of (id_agent, description, etat) VALUES ($id_agent, '$description', $etat)";

    // Exécute la requête
    if (mysqli_query($connexion, $sql)) {
        echo "OF ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'OF : " . mysqli_error($connexion);
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
</head>
<body>
    <h2>Ajouter un OF</h2>
    <form action="add_of.php" method="post">
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
        <button type="submit">Ajouter</button>
    </form>
    <button><a href="admin.php">Retour</a></button>
</body>
</html>
