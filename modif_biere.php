<?php
session_start();
include('inc/function.php');
include('inc/pdo.php');

if (!empty($_GET['nom'])) {
    $get_nom = $_GET['nom'];
}

if (!empty($_GET['nom'])) {   

    $sql = "SELECT * FROM produit WHERE nom LIKE '" . $get_nom . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $single_biere = $query->fetch();
} else {
    die('404');
}

if (!empty($_POST['submitted'])) {

    $nom   = trim(strip_tags($_POST['nom']));
    $poid  = trim(strip_tags($_POST['poid']));
    $prix  = trim(strip_tags($_POST['prix']));
    $stock = trim(strip_tags($_POST['stock']));
    $img   = trim(strip_tags($_POST['img']));

    $sql = "UPDATE produit SET nom = '$nom', poid = '$poid', prix = '$prix', stock = '$stock', img = '$img' WHERE nom LIKE '" . $get_nom . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $success = true;

    header('Location: admin.php');
}

if (!empty($_POST['supprimer'])) {

    $sql = "DELETE FROM produit WHERE nom LIKE '" . $get_nom . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $success = true;

    header('Location: admin.php');
}


include('inc/header.php'); ?>

<div class="compte_page">
    <h3>Modifier <?php echo $single_biere['nom'] ?></h3>

    <form action="modif_biere.php?nom=<?php echo $get_nom ?>" method="post" class="formulaire">

        <div class="champs">
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" value="<?php echo $single_biere['nom'] ?>">
        </div>

        <div class="champs">
            <label for="poid">Poid :</label><br>
            <input type="text" name="poid" id="poid" value="<?php echo $single_biere['poid'] ?>">
        </div>

        <div class="champs">
            <label for="prix">Prix :</label><br>
            <input type="text" name="prix" id="prix" value="<?php echo $single_biere['prix'] ?>">
        </div>

        <div class="champs">
            <label for="stock">Stock :</label><br>
            <input type="text" name="stock" id="stock" value="<?php echo $single_biere['stock'] ?>">
        </div>

        <div class="champs">
            <label for="img">Image :</label><br>
            <input type="text" name="img" id="img" value="<?php echo $single_biere['img'] ?>">
        </div>

        <input type="submit" name="submitted" id="boutonenvoyer" value="Modifier la bière">
    </form>

    <form action="modif_biere.php?nom=<?php echo $get_nom ?>" method="post" class="formulaire">

        <input type="submit" name="supprimer" id="boutonenvoyer" value="Supprimer la bière">
    </form>
    
</div>

<?php include('inc/footer.php'); ?>