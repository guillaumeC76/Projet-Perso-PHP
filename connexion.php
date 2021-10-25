<?php
session_start();
include ('inc/function.php');
include ('inc/pdo.php');

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $login    = trim(strip_tags($_POST['login']));
    $password = trim(strip_tags($_POST['password']));

    if (empty($login) || empty($password)) {
        $errors['login'] = 'Veuillez renseigner ce champ';
    } else {
        $sql = "SELECT * FROM users WHERE login = :login OR email = :login";
        $query = $pdo->prepare($sql);
        $query->bindValue(':login',$login,PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        if (!empty($user)) {
            if ($user['password'] === $user['comfirm_password']) {

                $_SESSION['login'] = array(
                    'id'     => $user['id_client'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'naissance' => $user['naissance'],
                    'telephone' => $user['telephone'],
                    'email' => $user['email'],
                    'login' => $user['login'],
                    'adresse' => $user['adresse'],
                    'pays' => $user['pays'],
                    'genre' => $user['genre'],
                    'admin' => $user['admin'],
                );

                header('location: liste_de_biere.php');

            } else {
                $errors['login'] = 'login ou email inconnu ou mot de passe oublié';
            }

        } else {
            $errors['login'] = 'login ou email inconnu';
        }
    }

}

include ('inc/header.php'); ?>

<h3>Connexion</h3>

<form action="connexion.php" method="post" class="formulaire">

    <div class="champs">
        <label for="login">login ou email *</label>
        <input type="text" name="login" id="login" value="<?php if (!empty($_POST['login'])) { echo $_POST['login'];}?>">
        <p class="erreur"><?php if (!empty($errors['login'])) { echo $errors['login']; } ?></p>
    </div>

    <div class="champs">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" value=""><br>
    </div>

    <span>Pas de compte ? <a href="inscription.php">Inscrivez-vous</a></span><br>

    <input type="submit" id="boutonenvoyer" name="submitted" value="connexion">

</form>

<?php include ('inc/footer.php');