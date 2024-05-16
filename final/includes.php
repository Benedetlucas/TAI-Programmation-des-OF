<?php
function call_header() {
    echo '
    <style>
        /* Style de l en-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }

        /* Style du logo */
        .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Style du menu */
        .menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .menu ul li:last-child {
            margin-right: 0;
        }

        .menu ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .menu ul li a:hover {
            text-decoration: underline;
        }

        /* Style du bouton de déconnexion */
        .logout button {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }

        .logout button:hover {
            background-color: #ccc;
        }
    </style>
    ';
    echo '
    <header class="header">
        <div class="logo">
            <h1>Jilora</h1>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="#">BigPicture</a></li>
                <li><a href="#">Détails</a></li>
                <li><a href="#">Archives</a></li>
            </ul>
        </nav>
        <div class="logout">
            <button>Log out</button>
        </div>
    </header>
    ';
}
?>
