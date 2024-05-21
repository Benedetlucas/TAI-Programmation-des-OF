<?php
$host = "localhost";
$dbname = "tai_app_2023_2024_crab";
$user = "tai_app_2023_2024_crab";
$pwd = "JLAF75JO6X";

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

// Vérifie si des données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les tableaux 'quantite' et 'temps' ont été envoyés
    if (isset($_POST['quantite']) && isset($_POST['temps'])) {
        // Récupère les tableaux envoyés
        $quantite = $_POST['quantite'];
        $temps = $_POST['temps'];

        // Prépare une requête SQL pour mettre à jour les opérations
        $sql_update = "UPDATE operation SET quantite = ?, temps = ? WHERE id = ?";
        $stmt_update = mysqli_prepare($connexion, $sql_update);

        // Vérifie si la préparation de la requête a réussi
        if ($stmt_update) {
            // Lie les variables aux paramètres de la requête
            mysqli_stmt_bind_param($stmt_update, "ddi", $new_quantite, $new_temps, $id_operation);

            // Parcourt les tableaux 'quantite' et 'temps' pour mettre à jour les opérations
            foreach ($quantite as $index => $new_quantite) {
                $new_temps = $temps[$index];
                $id_operation = $index + 1; // L'ID de l'opération commence à 1
                
                // Exécute la requête
                if (!mysqli_stmt_execute($stmt_update)) {
                    echo "Erreur lors de la mise à jour de l'opération avec l'ID $id_operation.";
                    exit();
                }
            }

            // Libère la ressource du statement
            mysqli_stmt_close($stmt_update);

            echo "Modifications enregistrées avec succès.";
        } else {
            echo "Erreur lors de la préparation de la requête.";
        }
    } else {
        echo "Données manquantes.";
    }
} else {
    echo "Accès non autorisé.";
}
?>
