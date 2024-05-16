<?php
// Assurez-vous d'avoir inclus la configuration de connexion à votre base de données
// Assurez-vous d'avoir inclus la configuration de connexion à votre base de données
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

session_start(); // Démarre la session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si le formulaire a été soumis

    // Récupère les données du formulaire
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifie si les champs sont remplis
    if (empty($identifiant) || empty($mot_de_passe)) {
        // Affiche un message d'erreur si un champ est vide
        echo "Veuillez remplir tous les champs.";
    } else {
        // Requête SQL pour vérifier les identifiants dans la base de données
        // Remplacez 'votre_table_agent' par le nom de votre table 'agent'
        $sql = "SELECT * FROM agent WHERE identifiant = '$identifiant' AND mot_de_passe = '$mot_de_passe'";
        
        // Exécute la requête
        $result = mysqli_query($connexion, $sql);
        
        // Vérifie s'il y a une correspondance dans la base de données
        if (mysqli_num_rows($result) == 1) {
            // Identifiants valides, crée une session pour l'utilisateur
            $_SESSION['identifiant'] = $identifiant;
            
            // Redirige l'utilisateur vers la page d'accueil
            
            $statu = "SELECT * FROM agent WHERE identifiant = '$identifiant' AND mot_de_passe = '$mot_de_passe'"; 
            if($statu[5] == 0){
                header("location: admin.php");
            }
            if($statu[5] == 1){
                header("location: operateur.php");
            }
        } else {
            // Identifiants invalides, affiche un message d'erreur
            echo "Identifiant ou mot de passe incorrect.";
        }
    }
}
?>
