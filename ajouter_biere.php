<?php
session_start();
include('inc/function.php');
include('inc/pdo.php');

if (!empty($_POST['submitted'])) {

    $nom    = trim(strip_tags($_POST['nom']));
    $poid     = trim(strip_tags($_POST['poid']));
    $prix     = trim(strip_tags($_POST['prix']));
    $description     = trim(strip_tags($_POST['description']));
    $stock     = trim(strip_tags($_POST['stock']));
    $img    = trim(strip_tags($_POST['img']));

    $sql = "INSERT INTO produit VALUES (null,:nom,:poid,:prix,:description,:stock,:img)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom',$nom,PDO::PARAM_STR);
        $query->bindValue(':poid',$poid,PDO::PARAM_STR);
        $query->bindValue(':prix',$prix,PDO::PARAM_STR);
        $query->bindValue(':description',$description,PDO::PARAM_STR);
        $query->bindValue(':stock',$stock,PDO::PARAM_STR);
        $query->bindValue(':img',$img,PDO::PARAM_STR);       
        $query->execute();
        $success = true;
}

include('inc/header.php'); ?>

<div class="compte_page">
    <h3>Ajouter une bière</h3>

    <form action="ajouter_biere.php" method="post" class="formulaire">

        <div class="champs">
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" value="">
        </div>

        <div class="champs">
            <label for="poid">Poid :</label><br>
            <input type="number" name="poid" id="poid" value="">
        </div>

        <div class="champs">
            <label for="prix">Prix :</label><br>
            <input type="number" name="prix" id="prix" value="">
        </div>

        <div class="champs">
            <label for="description">Description :</label><br>
            <input type="text" name="description" id="description" value="">
        </div>

        <div class="champs">
            <label for="stock">Stock :</label><br>
            <input type="number" name="stock" id="stock" value="">
        </div>

        <div class="champs">
            <label for="img">Image :</label><br>
            <input type="text" name="img" id="img" value="">
        </div>

        <input type="submit" name="submitted" id="boutonenvoyer" value="Ajouter la bière">
    </form>
    
</div>

<?php include('inc/footer.php'); ?>