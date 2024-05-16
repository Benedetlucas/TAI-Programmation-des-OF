<?php
// Inclure le fichier de connexion à la base de données
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

// Supprimer un agent s'il y a une demande
if(isset($_GET['supprimer_agent'])) {
    $id_agent = $_GET['supprimer_agent'];
    $sql_supprimer = "DELETE FROM agent WHERE id = '$id_agent'";
    if (mysqli_query($connexion, $sql_supprimer)) {
        echo "Agent supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'agent : " . mysqli_error($connexion);
    }
}

// Ajouter un agent s'il y a une demande
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $type = $_POST['type'];

    // Requête SQL pour ajouter un nouvel agent
    $sql_ajouter = "INSERT INTO agent (identifiant, mot_de_passe, prenom, nom, type) VALUES ('$identifiant', '$mot_de_passe', '$prenom', '$nom', '$type')";

    if (mysqli_query($connexion, $sql_ajouter)) {
        echo "Agent ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'agent : " . mysqli_error($connexion);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des agents</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="add_user.css"> 
</head>
<body>

<header>
    <!-- Votre header ici -->
    <!-- Exemple de code pour le header -->
    <h1>Gestion des agents</h1>
</header>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Identifiant</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Requête SQL pour obtenir la liste des agents
        $sql_agents = "SELECT * FROM agent";
        $result_agents = mysqli_query($connexion, $sql_agents);

        // Afficher les agents dans le tableau
        while ($row = mysqli_fetch_assoc($result_agents)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['identifiant'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td><a href='?supprimer_agent=" . $row['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="identifiant">Identifiant :</label>
    <input type="text" id="identifiant" name="identifiant" required><br>

    <label for="mot_de_passe">Mot de passe :</label>
    <input type="text" id="mot_de_passe" name="mot_de_passe" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="type">Type :</label>
    <select id="type" name="type" required>
        <option value="0">Admin</option>
        <option value="1">Opérateur</option>
    </select><br>

    <button type="submit">Ajouter</button>
</form>
    <?php
        // Requête SQL pour ajouter un nouvel agent
        $sql_ajouter = "INSERT INTO agent (identifiant, mot_de_passe, prenom, nom, type) VALUES ('$identifiant', '$mot_de_passe', '$prenom', '$nom', '$type')";

        if (mysqli_query($connexion, $sql_ajouter)) {
            echo "Agent ajouté avec succès.";
        } else {
        echo "Erreur lors de l'ajout de l'agent : " . mysqli_error($connexion);
        }
    ?>

</body>
</html>
