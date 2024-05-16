<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./global.css">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@600&display=swap">
    <title>Jilora</title>
</head>
<body>
    <div class="desktop-1">
        <header class="navigation">
            <div class="frame-parent">
                <div class="jilora-wrapper">
                    <h2 class="jilora">Jilora</h2>
                </div>
                <div class="administrateur">Administrateur</div>
            </div>
            <div class="segmented-control-wrapper">
                <div class="segmented-control">
                    <div class="item-1"><div class="bigpicture">Bigpicture</div></div>
                    <div class="item-2"><div class="dtails">Détails</div></div>
                    <div class="item-3"><div class="archives">Archives</div></div>
                    <div class="item-4"><div class="popular">Popular</div></div>
                    <div class="item-5"><div class="new-releases">New Releases</div></div>
                </div>
            </div>
            <div class="navigation-inner">
                <div class="frame-group">
                    <div class="button-parent">
                        <button class="button">
                            <img class="more-horizontal-icon" alt="More" src="./public/morehorizontal.svg">
                        </button>
                        <button class="button1">
                            <div class="log-out">Log out</div>
                        </button>
                    </div>
                    <div class="frame-wrapper">
                        <div class="avatar-parent">
                            <img class="avatar-icon" alt="Avatar" src="./public/avatar@2x.png">
                            <div class="chevron-down-wrapper">
                                <img class="chevron-down-icon" alt="Chevron Down" src="./public/chevrondown.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="desktop-1-inner">
            <section class="list-parent">
                <div class="list">
                    <div class="list-inner">
                        <div class="frame-container">
                            <div class="n-of-parent">
                                <div class="n-of">N° OF</div>
                                <div class="operateur">OPERATEUR</div>
                            </div>
                            <div class="consulter-parent">
                                <div class="consulter">CONSULTER</div>
                                <div class="modifier-wrapper">
                                    <div class="modifier">MODIFIER</div>
                                </div>
                                <div class="about-wrapper">
                                    <div class="about">Supprimer</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Répétez cette structure pour chaque élément de la liste -->
                    <div class="list1">
                        <div class="operator-o-f-parent">
                            <div class="operator-o-f">
                                <div class="of-1">OF 1</div>
                            </div>
                            <div class="dupont-wrapper">
                                <div class="dupont">DUPONT</div>
                            </div>
                            <div class="tamak-details">
                                <div class="progress-bar"></div>
                            </div>
                            <div class="image-details">
                                <div class="frame-div">
                                    <div class="image-1-wrapper">
                                        <img class="image-1-icon" loading="lazy" alt="Image 1" src="./public/image-1@2x.png">
                                    </div>
                                    <div class="logo-modifier-1-wrapper">
                                        <img class="logo-modifier-1" loading="lazy" alt="Modifier" src="./public/logo-modifier-1@2x.png">
                                    </div>
                                    <img class="logo-supprimer-1" loading="lazy" alt="Supprimer" src="./public/logo-supprimer-1@2x.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la structure répétée -->

                    <!-- Bouton pour créer un nouvel opérateur -->
                    <div class="button-wrapper">
                        <button class="button2">
                            <div class="crer-un-nouvel">Créer un nouvel Opérateur</div>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
