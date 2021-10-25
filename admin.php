<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$sql = "SELECT nom, prix, img FROM produit";
$query = $pdo->prepare($sql);
$query->execute();
$bieres = $query->fetchAll();

$sql2 = "SELECT * FROM users";
$query2 = $pdo->prepare($sql2);
$query2->execute();
$users = $query2->fetchAll();

$sql3 = "SELECT * FROM panier";
$query3 = $pdo->prepare($sql3);
$query3->execute();
$paniers = $query3->fetchAll();

$sql4 = "SELECT count(id_panier),id_client as 'nbr_panier' FROM `panier` GROUP BY id_client ";
$query4 = $pdo->prepare($sql4);
$query4->execute();
$nombres= $query4-> fetchAll();

$requete="SELECT
		users.nom as 'nom',
		users.prenom as 'prenom' ,
		users.id_client as 'client',
		SUM(panier.prix)as 'sum',
		panier.id_client 
	FROM
			`users`
	INNER JOIN 	
			panier ON users.id_client= panier.id_client
	GROUP BY panier.id_client
	ORDER BY sum DESC ";		
$result = $pdo -> query($requete);
$result = $result -> fetchAll(PDO::FETCH_ASSOC);
	
$requete2 =" SELECT COUNT(id_client) as 'client2', genre as 'genre' FROM `users` GROUP BY genre";
$result2 = $pdo -> query($requete2);
$result2 = $result2 -> fetchAll(PDO::FETCH_ASSOC);

include('inc/header.php'); ?>

<h3>Liste des commandes</h3>

<table class="tableau">
    <thead>
        <tr>
            <th>Panier</th>
            <th>Date de commande</th>
            <th>Date de réception</th>
            <th>Prix</th>
            <th>Etat de la commande</th>
            <th>Modifier la commande</th>
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
                <td><a href="http://localhost/A/modif_etat.php?panier=<?php echo $panier['id_panier'] ?>">Modifier la commande</a></td>
            </tr>

        <?php } ?>

    </tbody>
</table>


<h3>Liste des utilisateurs</h3>

<table class="fixed_headers">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Login</th>
            <th>Adresse</th>
            <th>Pays</th>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($users as $user) { ?>

            <tr>
                <td><?php echo $user['nom'] ?></td>
                <td><?php echo $user['prenom'] ?></td>
                <td><?php echo $user['naissance'] ?></td>
                <td><?php echo $user['telephone'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['login'] ?></td>
                <td><?php echo $user['adresse'] ?></td>
                <td><?php echo $user['pays'] ?></td>
                <td><?php echo $user['genre'] ?></td>
            </tr>

        <?php } ?>

    </tbody>
</table>

<h3>Liste des bières</h3>

<div class="formulaire">
    <a href="ajouter_biere.php" id="boutonajouter">Ajouter une bière</a>
</div>

<div class="biere_page">

    <?php foreach ($bieres as $biere) { ?>

        <a href="http://localhost/A/modif_biere.php?nom=<?php echo $biere['nom'] ?>">
            <div class="biere">
                <p>MODIFIER : <?php echo $biere['nom'] ?> - <?php echo $biere['prix'] ?>€</p>
                <img src="<?php echo $biere['img'] ?>" alt="bière">
            </div>
        </a>

    <?php } ?>

</div>

<div>
	<?php
		echo "<h3 align=\"center\">Statistique du site</h3>";
		
		echo "<h4 align=\"center\">Vente par client</h4>";
		
		echo"<table align=\"center\" width=\"500\" class=\"list\">";
		echo "<th>nom</th><th>prenom</th><th>client_id</th><th>total achat</th>";
		foreach($result as $key => $row){
		echo"<tr class=\"list\">";
		echo"<td class=\"list\">".$row['nom']."</td>";
		echo"<td class=\"list\">".$row['prenom']."</td>";
		echo"<td class=\"list\">".$row['client']."</td>";
		echo"<td class=\"list\">".$row['sum']."</td>";
		echo"</tr>";
		}
		echo "</table>";
		echo "<br>";
		
		$best= $result[0];
	$best_nom= $best['nom'];
	$best_prenom= $best['prenom'];
	$best_sum= $best['sum'];
	echo "Notre meilleur client est $best_nom  $best_prenom qui a acheté pour $best_sum euros chez nous";
	?>
</div>
<div>
	<?php
		echo"<table align=\"center\" width=\"500\" class=\"list\">";
	echo "<th>nombre</th><th>Homme/Femme</th>";
	foreach($result2 as $key2 => $row){
	echo"<tr class=\"list\">";
	echo"<td class=\"list\">".$row['client2']."</td>";
	echo"<td class=\"list\">".$row['genre']."</td>";
	echo"</tr>";
	}
	echo "</table>";
	
	echo"<br>";
	$femme= $result2[0];
	$homme= $result2[1];
	$pourcent= 100* $femme['client2']/($femme['client2']+$homme['client2']);
	$pourcent2= 100* $homme['client2']/($femme['client2']+$homme['client2']);
	echo "Il y a $pourcent% de femme chez nos clients et $pourcent2% d'homme.";
	?>
</div>
<?php include('inc/footer.php'); ?>