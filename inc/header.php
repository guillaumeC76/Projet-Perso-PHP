<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Pick a beer</title>
</head>

<body>

<header>

<img class="en-tete" src="assets/img/baniere.png" alt="biere">

    <?php if (!is_logged()) { ?>

        <div class="menu_header">
            <div class="option_menu"><a href="index.php">Accueil</a></div>
            <div class="option_menu"><a href="liste_de_biere.php">Liste de bières</a></div>
            <div class="option_menu"><a href="contact.php">Contact</a></div>
            <div class="option_menu"><a href="a_propos.php">A propos</a></div>
            <div class="option_menu"><a href="connexion.php">Inscription / connection</a></div>
        </div>

    <?php }elseif (is_admin()) { ?>

        <div class="menu_header">
            <div class="option_menu"><a href="index.php">Accueil</a></div>
            <div class="option_menu"><a href="liste_de_biere.php">Liste de bières</a></div>
            <div class="option_menu"><a href="compte.php">Mon compte</a></div>
            <div class="option_menu"><a href="admin.php">Page Admin</a></div>
            <div class="option_menu"><a href="deconnexion.php">Déconnexion</a></div>
        </div>
    
    <?php } else { ?>

        <div class="menu_header">
            <div class="option_menu"><a href="index.php">Accueil</a></div>
            <div class="option_menu"><a href="liste_de_biere.php">Liste de bières</a></div>
            <div class="option_menu"><a href="contact.php">Contact</a></div>
            <div class="option_menu"><a href="a_propos.php">A propos</a></div>
            <div class="option_menu"><a href="panier.php">Mon panier</a></div>
            <div class="option_menu"><a href="commande.php">Mes commandes</a></div>
            <div class="option_menu"><a href="compte.php">Mon compte</a></div>
            <div class="option_menu"><a href="deconnexion.php">Déconnexion</a></div>
        </div>

    <?php }?>

    <div>
        <div class="starsec"></div>
        <div class="starthird"></div>
        <div class="starfourth"></div>
        <div class="starfifth"></div>
    </div>
</header>

<div class="marge">