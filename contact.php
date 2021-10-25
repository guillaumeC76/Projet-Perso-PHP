<?php
session_start();
include('inc/function.php');
include('inc/header.php'); ?>

<div class="home_page">

    <h3>Formulaire de contact</h3>

    <form action="contact.php" method="post" class="formulaire">

        <div class="champs">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div class="champs">
            <label for="prenom">Prénom</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div class="champs">
            <label for="nom">Email</label>
            <input type="email" name="prenom" id="prenom">
        </div>

        <div class="champs">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse">
        </div>

        <div class="champs">
            <label for="code_postal">Code postal</label>
            <input type="number" name="code_postal" id="code_postal">
        </div>

        <div class="champs">
            <label for="Ville">Ville</label>
            <input type="text" name="Ville" id="Ville">
        </div>

        <div class="champs">
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
        </div>

        <div class="champs">
            <input type="submit" value="Envoyer" id="boutonenvoyer">
            <input type="submit" value="Reinitialiser" id="boutonenvoyer">
        </div>

    </form>
</div>

<?php include('inc/footer.php'); ?>