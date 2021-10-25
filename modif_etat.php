<?php
session_start();
include('inc/function.php');
include('inc/pdo.php');

if (!empty($_GET['panier'])) {
    $get_panier = $_GET['panier'];
}

if (!empty($_GET['panier'])) {   

    $sql = "SELECT etat_commande FROM panier WHERE id_panier LIKE '" . $get_panier . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $panier = $query->fetch();
} else {
    die('404');
}

if (!empty($_POST['submitted'])) {

    // Protection des failles XSS
    $etat_commande    = trim(strip_tags($_POST['etat_commande']));

    // Insert
    $sql = "UPDATE panier SET etat_commande = '$etat_commande' WHERE id_panier LIKE '" . $get_panier . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $success = true;

    header('Location: admin.php');
}

if (!empty($_POST['supprimer'])) {

    $sql = "DELETE FROM panier WHERE id_panier LIKE '" . $get_panier . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $success = true;

    header('Location: admin.php');
}


include('inc/header.php'); ?>

<div class="compte_page">
    <h3>Modifier l'état de la commande</h3>

    <p class="reception">Suppression seulement autorisée si la commande à été payé et réceptionné</p>

    <form action="modif_etat.php?panier=<?php echo $get_panier ?>" method="post" class="formulaire">

        <div class="champs">
            <label for="etat_commande">Etat de la commande :</label><br>
            <input type="text" name="etat_commande" id="etat_commande" value="<?php echo $panier['etat_commande'] ?>">
        </div>

        <input type="submit" name="submitted" id="boutonenvoyer" value="Modifier l'état">
    </form>

    <form action="modif_etat.php?panier=<?php echo $get_panier ?>" method="post" class="formulaire">
        <input type="submit" name="supprimer" id="boutonenvoyer" value="Supprimer la commande">
    </form>
    
</div>

<?php include('inc/footer.php'); ?>