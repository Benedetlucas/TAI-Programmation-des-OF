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
        body {
            margin: 0;
            line-height: normal;
            font-family: var(--small-text);
            background-color: var(--color-white);
            color: var(--color-black);
        }

        :root {
            /* Fonts */
            --small-text: 'Inter', sans-serif;

            /* Font sizes */
            --small-text-size: 16px;
            --body-text-size: 20px;

            /* Colors */
            --color-white: #fff;
            --color-black: #000;
            --color-gray: #828282;
            --color-gainsboro-100: #e6e6e6;
            --color-gainsboro-200: #e0e0e0;
            --color-primary: #4CAF50; /* Green */
            --color-primary-dark: #45a049;

            /* Paddings */
            --padding-5xl: 24px;
            --padding-xl: 20px;
            --padding-10xs: 3px;
            --padding-mini: 15px;
            --padding-xs-5: 11.5px;

            /* Border radiuses */
            --br-5xs: 8px;
        }

        /* Table styling */
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Button styling */
        button, .button {
            display: inline-block;
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: var(--padding-mini) var(--padding-xl);
            text-align: center;
            text-decoration: none;
            font-size: var(--small-text-size);
            margin: var(--padding-mini) 0;
            cursor: pointer;
            border: none;
            border-radius: var(--br-5xs);
            transition: background-color 0.3s ease;
        }

        button:hover, .button:hover {
            background-color: var(--color-primary-dark);
        }

        button a, .button a {
            color: var(--color-white);
            text-decoration: none;
        }
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

                // Afficher les opérations dans le tableau
                while ($row = mysqli_fetch_assoc($result_operations)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_of']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nom_matiere']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cout']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['temps']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </section>
    </main>
</body>
</html>

<?php
// Fermer la connexion
mysqli_close($connexion);
?>
