<?php
session_start();
include('inc/function.php');
include('inc/pdo.php');

$sql = "SELECT * FROM users WHERE id_client LIKE '" . $_SESSION['login']['id'] . "%'";
$query = $pdo->prepare($sql);
$query->execute();
$user = $query->fetch();

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $nom    = trim(strip_tags($_POST['nom']));
    $prenom     = trim(strip_tags($_POST['prenom']));
    $naissance     = trim(strip_tags($_POST['naissance']));
    $telephone     = trim(strip_tags($_POST['telephone']));
    $email     = trim(strip_tags($_POST['email']));
    $login    = trim(strip_tags($_POST['login']));
    $adresse     = trim(strip_tags($_POST['adresse']));
    $pays     = trim(strip_tags($_POST['pays']));
    $genre    = trim(strip_tags($_POST['genre']));

    // Insert
    $sql = "UPDATE users SET nom = '$nom', prenom = '$prenom', naissance = '$naissance', telephone = '$telephone', email = '$email', login = '$login', adresse = '$adresse', pays = '$pays', genre = '$genre' WHERE id_client LIKE '" . $_SESSION['login']['id'] . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $success = true;

    header('Location: compte.php');
}


include('inc/header.php'); ?>

<div class="compte_page">
    <h3>Mon compte</h3>

    <form action="compte.php" method="post" class="formulaire">

    <div class="champs">
        <label for="nom">Nom :</label><br>
        <input type="text" name="nom" id="nom" value="<?php echo $user['nom'] ?>">
    </div>

    <div class="champs">
        <label for="prenom">Prénom :</label><br>
        <input type="text" name="prenom" id="prenom" value="<?php echo $user['prenom'] ?>">
    </div>

    <div class="champs">
        <label for="naissance">Date de naissance :</label><br>
        <input type="text" name="naissance" id="naissance" value="<?php echo $user['naissance'] ?>">
    </div>

    <div class="champs">
        <label for="telephone">Téléphone :</label><br>
        <input type="text" name="telephone" id="telephone" value="<?php echo $user['telephone'] ?>">
    </div>

    <div class="champs">
        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>">
    </div>

    <div class="champs">
        <label for="login">Login :</label><br>
        <input type="text" name="login" id="login" value="<?php echo $user['login'] ?>">
    </div>

    <div class="champs">
        <label for="adresse">Adresse :</label><br>
        <input type="text" name="adresse" id="adresse" value="<?php echo $user['adresse'] ?>">
    </div>

    <div class="champs">
        <label for="pays">Pays :</label><br>
        <input type="text" name="pays" id="pays" value="<?php echo $user['pays'] ?>">
    </div>

    <div class="champs">
        <label for="genre">Genre :</label><br>
        <input type="text" name="genre" id="genre" value="<?php echo $user['genre'] ?>">
    </div>

    <input type="submit" name="submitted" id="boutonenvoyer" value="Modifier mes infos">
</form>
    
</div>

<?php include('inc/footer.php'); ?>