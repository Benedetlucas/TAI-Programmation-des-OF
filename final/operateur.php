<?php
// Assurez-vous d'avoir inclus tous les fichiers nécessaires
include_once __DIR__ . '/includes.php';

// Appel à la fonction call_header() pour inclure l'en-tête de la page
call_header();
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Si l'utilisateur n'est pas connecté, redirige-le vers la page de connexion
    header("Location: index.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Affiche le contenu de la page d'accueil
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global_operateur.css" />
    <link rel="stylesheet" href="./index_operateur.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
    />
  </head>
  <body>
      <div class="search">
        <img class="search-icon" alt="" src="./public/search.svg" />

        <div class="label">Search...</div>
      </div>
      <main class="bar-chart-wrapper">
        <section class="bar-chart">
          <div class="of-2-parent">
            <div class="of-2">OF 2</div>
            <div class="assign-danae-mark-wrapper">
              <div class="assign">Assigné à : Danae Mark</div>
            </div>
          </div>
          <div class="description-container">
            <p class="description">
              <span class="description1">Description</span>
              <span>
                :
                ..............................................................................................................................................................................................</span
              >
            </p>
            <p class="p">
              .........................................................................................................................................................................................................................................................................................................................................................................................................
            </p>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>
