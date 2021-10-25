<?php
session_start();
include ('inc/function.php');
include ('inc/pdo.php');
$errors = array();
$success = false;

// Traitement de formulaire

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $nom    = trim(strip_tags($_POST['nom']));
    $prenom     = trim(strip_tags($_POST['prenom']));
    $naissance     = trim(strip_tags($_POST['naissance']));
    $telephone     = trim(strip_tags($_POST['telephone']));
    $email     = trim(strip_tags($_POST['email']));
    $login    = trim(strip_tags($_POST['login']));
    $password1 = trim(strip_tags($_POST['password1']));
    $password2 = trim(strip_tags($_POST['password2']));
    $adresse     = trim(strip_tags($_POST['adresse']));
    $pays     = trim(strip_tags($_POST['pays']));
    $genre    = trim(strip_tags($_POST['genre']));

    // 3 - Password
    if (!empty($password1)) {
        if ($password1 != $password2) {
            $errors['password'] = 'Vos mots de passe doivent être identiques';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner un mot de passe';
    }

    if (count($errors) == 0) {

        // Insert
        $sql = "INSERT INTO users VALUES (null,:nom,:prenom,:naissance,:telephone,:email,:login,:password,:comfirm_password,:adresse,:pays,:genre,'non')";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $query->bindValue(':naissance',$naissance,PDO::PARAM_STR);
        $query->bindValue(':telephone',$telephone,PDO::PARAM_STR);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':login',$login,PDO::PARAM_STR);       
        $query->bindValue(':password',$password1,PDO::PARAM_STR);
        $query->bindValue(':comfirm_password',$password2,PDO::PARAM_STR);
        $query->bindValue(':adresse',$adresse,PDO::PARAM_STR);
        $query->bindValue(':pays',$pays,PDO::PARAM_STR);
        $query->bindValue(':genre',$genre,PDO::PARAM_STR);
        $query->execute();
        $success = true;

        // Redirection vers la connexion
        header('Location: connexion.php');
    }
}

include ('inc/header.php'); ?>

<h3>Inscription</h3>

<form action="inscription.php" method="post" class="formulaire">

    <div class="champs">
        <label for="nom">Nom :</label><br>
        <input type="text" name="nom" id="nom" value="<?php if (!empty($_POST['nom'])) { echo $_POST['nom'];}?>">
        <p class="erreur"><?php if (!empty($errors['nom'])) { echo $errors['nom']; } ?></p>
    </div>

    <div class="champs">
        <label for="prenom">Prénom :</label><br>
        <input type="text" name="prenom" id="prenom" value="<?php if (!empty($_POST['prenom'])) { echo $_POST['prenom'];}?>">
        <p class="erreur"><?php if (!empty($errors['prenom'])) { echo $errors['prenom']; } ?></p>
    </div>

    <div class="champs">
        <label for="naissance">Date de naissance :</label><br>
        <input type="text" name="naissance" id="naissance" value="<?php if (!empty($_POST['naissance'])) { echo $_POST['naissance'];}?>">
        <p class="erreur"><?php if (!empty($errors['naissance'])) { echo $errors['naissance']; } ?></p>
    </div>

    <div class="champs">
        <label for="telephone">Téléphone :</label><br>
        <input type="text" name="telephone" id="telephone" value="<?php if (!empty($_POST['telephone'])) { echo $_POST['telephone'];}?>">
        <p class="erreur"><?php if (!empty($errors['telephone'])) { echo $errors['telephone']; } ?></p>
    </div>

    <div class="champs">
        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" value="<?php if (!empty($_POST['email'])) { echo $_POST['email'];}?>">
        <p class="erreur"><?php if (!empty($errors['email'])) { echo $errors['email']; } ?></p>
    </div>

    <div class="champs">
        <label for="login">Login :</label><br>
        <input type="text" name="login" id="login" value="<?php if (!empty($_POST['login'])) { echo $_POST['login'];}?>">
        <p class="erreur"><?php if (!empty($errors['login'])) { echo $errors['login']; } ?></p>
    </div>

    <div class="champs">
        <label for="adresse">Adresse :</label><br>
        <input type="text" name="adresse" id="adresse" value="<?php if (!empty($_POST['adresse'])) { echo $_POST['adresse'];}?>">
        <p class="erreur"><?php if (!empty($errors['adresse'])) { echo $errors['adresse']; } ?></p>
    </div>

    <div class="champs">
        <label for="pays">Pays :</label><br>
        <input type="text" name="pays" id="pays" value="<?php if (!empty($_POST['pays'])) { echo $_POST['pays'];}?>">
        <p class="erreur"><?php if (!empty($errors['pays'])) { echo $errors['pays']; } ?></p>
    </div>

    <div class="champs">
        <label for="genre">Genre (M/F) :</label><br>
        <input type="text" name="genre" id="genre" value="<?php if (!empty($_POST['genre'])) { echo $_POST['genre'];}?>">
        <p class="erreur"><?php if (!empty($errors['genre'])) { echo $errors['genre']; } ?></p>
    </div>

    <div class="champs">
        <label for="password1">Mot de passe :</label><br>
        <input type="password" name="password1" id="password1" value="">
        <p class="erreur"><?php if (!empty($errors['password'])) { echo $errors['password']; } ?></p>
    </div>

    <div class="champs">
        <label for="password2">Confirmez votre mot de passe :</label><br>
        <input type="password" name="password2" id="password2" value="">
    </div>

    <input type="submit" name="submitted" id="boutonenvoyer" value="Inscrivez-vous">
</form>


<?php include ('inc/footer.php');