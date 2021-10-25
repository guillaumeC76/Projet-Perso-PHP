<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

if (!empty($_GET['nom'])) {
    $get_nom = $_GET['nom'];
}

if (is_logged()) {
    $compteur = $_SESSION['login']['id'];
}

if (!empty($_POST['submitted'])) {

    $sql = "INSERT INTO item VALUES (null,:id_panier,:id_produit,:quantite)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_panier', $compteur, PDO::PARAM_STR);
    $query->bindValue(':id_produit', $get_nom, PDO::PARAM_STR);
    $query->bindValue(':quantite', '1', PDO::PARAM_STR);
    $query->execute();
    $item = $query->fetch();

    header('Location: liste_de_biere.php');
}

if (!empty($_GET['nom'])) {

    $sql2 = "SELECT * FROM produit WHERE nom LIKE '" . $get_nom . "%'";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $single_biere = $query2->fetch();
} else {
    die('404');
}

include('inc/header.php'); ?>
<div class="all_single_biere">
    <div class="single_biere">
        <h2><?php echo $single_biere['nom']; ?></h2>
        <img src="<?php echo $single_biere['img'] ?>" alt="<?php echo $single_biere['nom']; ?>">
        <h4>Il reste <?php echo $single_biere['stock']; ?> produits en stock</h4>
    </div>
    <div class="description_biere">
        <p><?php echo $single_biere['description']; ?></p>
        <?php if (is_logged()) { ?>
            <form action="single_biere.php?nom=<?php echo $get_nom ?>" method="post" class="formulaire">
                <input type="submit" id="boutonenvoyerpanier" name="submitted" value="Ajouter au panier">
            </form>
        <?php } else {
            header('Location: connexion.php');
        } ?>

    </div>
</div>

<?php include('inc/footer.php');
