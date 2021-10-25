<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$client_id = $_SESSION['login']['id'];

$sql = "SELECT * FROM panier WHERE id_client LIKE '" . $client_id . "%'";
$query = $pdo->prepare($sql);
$query->execute();
$paniers = $query->fetchAll();

include('inc/header.php'); ?>

<h3>Liste de vos commandes</h3>

<p class="reception">Venez receptionner votre commande en magasin à la date de reception indiquée</p>

<table class="tableau">
    <thead>
        <tr>
            <th>Panier</th>
            <th>Date de commande</th>
            <th>Date de réception</th>
            <th>Prix</th>
            <th>Etat de la commande</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($paniers as $panier) { ?>

            <tr>
                <td><?php echo $panier['biere'] ?></td>
                <td><?php echo $panier['date_commande'] ?></td>
                <td><?php echo $panier['date_reception'] ?></td>
                <td><?php echo $panier['prix'] ?></td>
                <td><?php echo $panier['etat_commande'] ?></td>
            </tr>

        <?php } ?>

    </tbody>
</table>


<?php include('inc/footer.php');
