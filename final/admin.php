<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jilora</title>
    <link rel="stylesheet" href="./global.css">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Abel:wght@600&display=swap">
</head>
<body>
    <header class="navigation">
        <div class="frame-parent">
            <h1 class="jilora">Jilora</h1>
            <div class="administrateur">Administrateur</div>
        </div>
        <nav class="segmented-control">
            <div class="segmented-control1">
                <div class="item-1"><div class="bigpicture">Bigpicture</div></div>
                <div class="item-2"><div class="dtails">Détails</div></div>
                <div class="item-3"><div class="archives">Archives</div></div>
                <div class="item-4"><div class="popular">Popular</div></div>
                <div class="item-5"><div class="new-releases">New Releases</div></div>
            </div>
        </nav>
        <div class="button-logout">
            <button class="button">
                <div class="log-out">Log out</div>
            </button>
        </div>
    </header>

    <main>
        <section class="list">
            <div class="list1">
                <div class="list-inner">
                    <div class="frame-group">
                        <div class="n-of-parent">
                            <div class="n-of">N° OF</div>
                            <div class="operateur">OPERATEUR</div>
                        </div>
                        <div class="button-consulter-modifier">
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

                <!-- List items -->
                <div class="list-items">
                    <div class="frame-container">
                        <div class="of-wrapper">
                            <div class="of">OF 1</div>
                        </div>
                        <div class="operator-wrapper">
                            <div class="operator">DUPONT</div>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div class="progress-bar"></div>
                        </div>
                        <div class="frame-wrapper">
                            <div class="frame-div">
                                <div class="image-wrapper">
                                    <img class="image-icon" loading="lazy" alt="Image 1" src="./public/image-1@2x.png">
                                </div>
                                <div class="logo-modifier-wrapper">
                                    <img class="logo-modifier" loading="lazy" alt="Modifier" src="./public/logo-modifier-1@2x.png">
                                </div>
                                <img class="logo-supprimer" loading="lazy" alt="Supprimer" src="./public/logo-supprimer-1@2x.png">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of list items -->

            </div>
        </section>
    </main>

    <footer>
        <div class="button-parent">
            <button class="button1">
                <div class="crer-un-nouvel">Créer un nouvel Opérateur</div>
            </button>
            <div class="button2">
                <div class="crer-un-nouvel1">Créer un nouvel OF</div>
            </div>
        </div>
    </footer>
</body>
</html>
