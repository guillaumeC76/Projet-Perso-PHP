<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$client_id = $_SESSION['login']['id'];

$sql = "SELECT * FROM item WHERE id_panier LIKE '" . $client_id . "%'";
$query = $pdo->prepare($sql);
$query->execute();
$item = $query->fetchAll();

if (!empty($_POST['submitted'])) {

    if (!empty($_GET['nom'])) {
        $the_nom = $_GET['nom'];
    }
    $sql2 = "UPDATE item SET quantite = quantite + 1 WHERE nom_produit LIKE '" . $the_nom . "%'";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $success = true;

    header('Location: panier.php');
}

if (!empty($_POST['submittedmoins'])) {

    if (!empty($_GET['nom'])) {
        $the_nom = $_GET['nom'];
    }
    $sql4 = "UPDATE item SET quantite = quantite - 1 WHERE nom_produit LIKE '" . $the_nom . "%'";
    $query4 = $pdo->prepare($sql4);
    $query4->execute();
    $success = true;

    header('Location: panier.php');
}

if (!empty($_POST['submittedsupprimer'])) {

    if (!empty($_GET['nom'])) {
        $the_nom = $_GET['nom'];
    }
    $sql6 = "DELETE FROM item WHERE nom_produit LIKE '" . $the_nom . "%'";
    $query6 = $pdo->prepare($sql6);
    $query6->execute();
    $success = true;

    header('Location: panier.php');
}

$mega_total = 0;
$biere = array();

include('inc/header.php'); ?>

<h3>Mon panier</h3>

<div class="panier_page">

    <?php foreach ($item as $it) {

        $get_nom = $it['nom_produit'];

        if ($it['quantite'] < 1) {
            $sql5 = "DELETE FROM item WHERE nom_produit LIKE '" . $get_nom . "%'";
            $query5 = $pdo->prepare($sql5);
            $query5->execute();
            $success = true;

            header('Location: panier.php');
        }

        $sql3 = "SELECT * FROM produit  WHERE nom LIKE '" . $get_nom . "%'";
        $query3 = $pdo->prepare($sql3);
        $query3->execute();
        $get_name = $query3->fetchAll();

        $mega_total += $get_name[0]['prix'] * $it['quantite'];
        array_push($biere, $get_name[0]['nom'] . ' x ' . $it['quantite']); ?>

        <div class="panier">
            <form action="panier.php?nom=<?php echo $get_nom ?>" method="post" class="formulaire">
                <p><?php echo $get_name[0]['nom'] ?> - <?php echo $get_name[0]['prix'] ?> € - X <?php echo $it['quantite'] ?> - Total = <?php echo $get_name[0]['prix'] * $it['quantite']; ?> €</p>
                <input type="submit" name="submitted" id="boutonenvoyer2" value="+1">
                <input type="submit" name="submittedmoins" id="boutonenvoyer2" value="-1">
                <input type="submit" name="submittedsupprimer" id="boutonenvoyer2" value="Supprimer">
            </form>
        </div>

    <?php } ?>

</div>

<h3>Total du panier = <?php echo $mega_total ?> €</h3>

<form action="panier.php" method="post" class="formulaire">
    <input type="submit" name="valider" id="boutonenvoyer" value="Valider mon panier">
</form>

<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');
$date_commande = utf8_encode(strftime('%A %d %B %Y, %H:%M'));
$date_reception = date('d-m-Y', strtotime($date_commande. ' + 5 days'));


if (!empty($_POST['valider'])) {

    // Insert
    $sql = "INSERT INTO panier VALUES (null,:date_commande,:date_reception,:prix,:etat_commande,:id_client, :biere)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':date_commande', $date_commande, PDO::PARAM_STR);
    $query->bindValue(':date_reception', $date_reception, PDO::PARAM_STR);
    $query->bindValue(':prix', $mega_total, PDO::PARAM_STR);
    $query->bindValue(':etat_commande', 'En cours', PDO::PARAM_STR);
    $query->bindValue(':id_client', $client_id, PDO::PARAM_STR);
    $query->bindValue(':biere', json_encode($biere), PDO::PARAM_STR);
    $query->execute();
    $success = true;

    $sql6 = "DELETE FROM item WHERE id_panier LIKE '" . $client_id . "%'";
    $query6 = $pdo->prepare($sql6);
    $query6->execute();
    $success = true;

    header('Location: commande.php');
}

include('inc/footer.php'); ?>